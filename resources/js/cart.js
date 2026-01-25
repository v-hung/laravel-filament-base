document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".btn-add-to-cart");

    // Lấy CSRF token từ meta
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    buttons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const productId = this.dataset.productId;
            const quantity = 1;

            fetch(window.routes.ADD_CART, {
                method: "POST",
                credentials: "include", // gửi cookie session
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    "X-Requested-With": "XMLHttpRequest",
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity,
                }),
            })
                .then((res) => res.json())
                .then((data) => {
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Thành công",
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false,
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Lỗi",
                            text: data.message,
                        });
                    }
                })
                .catch((error) => {
                    console.error(error);
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi",
                        text: "Không thể thêm sản phẩm vào giỏ hàng",
                    });
                });
        });
    });
});
