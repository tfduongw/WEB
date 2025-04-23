function showLoginModal(loginPath) {
  // Tạo modal container và thêm vào body
  const modalContainer = document.createElement("div");
  modalContainer.id = "modal-container";

  // Tạo HTML cho modal
  modalContainer.innerHTML = `
      <div class="modal" id="modal-demo">
        <div class="modal_header">
          <h3>Thông báo</h3>
          <button id="btn-close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal_body">
          <p>Bạn cần đăng nhập trước khi mua hàng</p>
          <a href="${loginPath}">Đăng nhập</a>
        </div>
      </div>
    `;

  document.body.appendChild(modalContainer);

  const btnClose = document.getElementById("btn-close");
  const modalDemo = document.getElementById("modal-demo");

  modalContainer.classList.add("show");

  btnClose.addEventListener("click", function () {
    modalContainer.classList.remove("show");
    setTimeout(() => {
      document.body.removeChild(modalContainer);
    }, 300);
  });

  modalContainer.addEventListener("click", function (e) {
    if (!modalDemo.contains(e.target)) {
      btnClose.click();
    }
  });

  if (!document.getElementById("modal-style")) {
    const style = document.createElement("style");
    style.id = "modal-style";
    style.textContent = `
        * {
        box-sizing: border-box;
      }

      body {
        font-family: Arial, Helvetica, sans-serif;
        line-height: 1.3;
      }

      #modal-container {
        height: 100vh;
        background-color: rgb(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        /* left: 0; */
        width: 100%;
        opacity: 0;
        pointer-events: none;
      }

      #modal-container.show {
        opacity: 1;
        pointer-events: all;
      }

      .modal {
        background-color: #ffff;
        max-width: 500px;
        position: relative;
        left: 50%;
        top: 100px;
        transform: translateX(-50%);
      }

      .modal .modal_header {
        display: flex;
        position: relative;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        border-bottom: 1px solid gray;
      }

      .modal_header h3 {
        margin: 0;
        text-align: center;
        flex-grow: 1;
      }

      button#btn-close {
        width: 30px;
        height: 30px;
        border: none;
        font-size: 20px;
        color: white;
        align-items: center;
        background-color: #f37319;
        border-radius: 20px;
        cursor: pointer;
        position: absolute;
        top: -5px;
        right: -5px;
      }

      .modal .modal_body {
        padding: 10px 20px 15px;
      }

      .modal_body p {
        text-align: center;
      }

      .modal_body a {
        text-decoration: none;
        background: #f37319;
        color: #fff;
        display: block;
        padding: 5px 15px;
        text-align: center;
        margin: 10px auto;
        width: fit-content;
        border-radius: 10px;
      }
      `;
    document.head.appendChild(style);
  }

  document
    .querySelector(".modal_body a")
    .addEventListener("click", function (e) {
      e.preventDefault();
      window.location.href = loginPath;
    });
}

function showSignUp(loginPath) {
  // Tạo modal container và thêm vào body
  const modalContainer = document.createElement("div");
  modalContainer.id = "modal-container";

  // Tạo HTML cho modal
  modalContainer.innerHTML = `
      <div class="modal" id="modal-demo">
        <div class="modal_header">
          <h3>Thông báo</h3>
          <button id="btn-close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="modal_body">
          <p>Tài khoản đã tồn tại</p>
          <a href="${loginPath}">Đăng nhập</a>
        </div>
      </div>
    `;

  document.body.appendChild(modalContainer);

  const btnClose = document.getElementById("btn-close");
  const modalDemo = document.getElementById("modal-demo");

  modalContainer.classList.add("show");

  btnClose.addEventListener("click", function () {
    modalContainer.classList.remove("show");
    setTimeout(() => {
      document.body.removeChild(modalContainer);
    }, 300);
  });

  modalContainer.addEventListener("click", function (e) {
    if (!modalDemo.contains(e.target)) {
      btnClose.click();
    }
  });

  if (!document.getElementById("modal-style")) {
    const style = document.createElement("style");
    style.id = "modal-style";
    style.textContent = `
        * {
        box-sizing: border-box;
      }

      body {
        font-family: Arial, Helvetica, sans-serif;
        line-height: 1.3;
      }

      #modal-container {
        height: 100vh;
        background-color: rgb(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        /* left: 0; */
        width: 100%;
        opacity: 0;
        pointer-events: none;
      }

      #modal-container.show {
        opacity: 1;
        pointer-events: all;
      }

      .modal {
        background-color: #ffff;
        max-width: 500px;
        position: relative;
        left: 50%;
        top: 100px;
        transform: translateX(-50%);
      }

      .modal .modal_header {
        display: flex;
        position: relative;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        border-bottom: 1px solid gray;
      }

      .modal_header h3 {
        margin: 0;
        text-align: center;
        flex-grow: 1;
      }

      button#btn-close {
        width: 30px;
        height: 30px;
        border: none;
        font-size: 20px;
        color: white;
        align-items: center;
        background-color: #f37319;
        border-radius: 20px;
        cursor: pointer;
        position: absolute;
        top: -5px;
        right: -5px;
      }

      .modal .modal_body {
        padding: 10px 20px 15px;
      }

      .modal_body p {
        text-align: center;
      }

      .modal_body a {
        text-decoration: none;
        background: #f37319;
        color: #fff;
        display: block;
        padding: 5px 15px;
        text-align: center;
        margin: 10px auto;
        width: fit-content;
        border-radius: 10px;
      }
      `;
    document.head.appendChild(style);
  }

  document
    .querySelector(".modal_body a")
    .addEventListener("click", function (e) {
      e.preventDefault();
      window.location.href = loginPath;
    });
}
