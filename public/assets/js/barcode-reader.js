$(document).ready(function () {
    const input = $("#product_code");
    const status = $("#barcode-status");
    let scanTimeout;

    // When scan button clicked → focus input & wait for scan
    $("#barcode-reader").on("click", function () {
        input.val("").focus();
        status.text("Waiting for barcode...");

        // If no input within 5 seconds → assume no scanner
        clearTimeout(scanTimeout);
        scanTimeout = setTimeout(() => {
            if (input.val().trim() === "") {
                status.text("❌ Barcode reader not connected");
            }
        }, 5000);
    });

    // When scanner inputs code + Enter → capture
    input.on("change", function () {
        let code = $(this).val().trim();
        if (code !== "") {
            clearTimeout(scanTimeout); // cancel "not connected" check
            status.text("✅ Barcode scanned successfully");

            // 👉 AJAX request to backend
            $.ajax({
                url: "/products/getByCode/" + code,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        $("#product_name").val(response.product_name);
                    } else {
                        $("#product_name").val("Not found");
                    }
                },
                error: function () {
                    $("#product_name").val("Error fetching product");
                }
            });
        }
    });
});