<?php

namespace App\Controllers;

use App\Models\SettingsModel;
use CodeIgniter\Controller;

class Settings extends Controller
{
    public function index()
    {
        $settingsModel = new SettingsModel();
        $data['settings'] = $settingsModel->first(); // Get first row (if exists)
        $data['title'] = 'Settings';
        return view('dashboard/settings', $data);
    }

    public function update()
    {
        $settingsModel = new SettingsModel();

        try {
            $data = [];
            $fields = [
                'store_name',
                'store_email',
                'store_phone',
                'store_lanphone',
                'shop_registration_number',
                'store_address'
            ];

            // 🔹 Add only existing POST fields
            foreach ($fields as $field) {
                $value = $this->request->getPost($field);
                if ($value !== null) {
                    $data[$field] = $value;
                }
            }

            // 🔹 Handle logo upload
            $file = $this->request->getFile('shop_logo');
            if ($file && $file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads', $newName);
                $data['shop_logo'] = $newName;
            }

            // 🔹 Always update timestamp
            $data['updated_at'] = date('Y-m-d H:i:s');

            $existing = $settingsModel->first();

            if (!$existing) {
                $settingsModel->insert($data);
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Settings saved successfully (new record).'
                ]);
            } else {
                $settingsModel->update($existing['id'], $data);
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Settings updated successfully.'
                ]);
            }
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Error: ' . $th->getMessage()
            ]);
        }
    }
    public function removeLogo()
    {
        $settingsModel = new SettingsModel();

        try {
            $existing = $settingsModel->first();

            if (!$existing) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No settings record found.'
                ]);
            }

            // 🔹 Remove logo file from uploads folder if it exists
            if (!empty($existing['shop_logo'])) {
                $filePath = FCPATH . 'uploads/' . $existing['shop_logo'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // 🔹 Update DB record to remove logo reference
            $settingsModel->update($existing['id'], [
                'shop_logo' => null,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Logo removed successfully.'
            ]);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Error: ' . $th->getMessage()
            ]);
        }
    }


}
