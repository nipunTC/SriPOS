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
});