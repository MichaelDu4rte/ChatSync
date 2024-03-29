const form = document.querySelector('.login form');
const continueBtn = document.querySelector('.btn input');
const errorTxt = document.querySelector('.error-text');

form.onsubmit = (e) => {
    e.preventDefault();
}

continueBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("Post", "php/login.php", true);

    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                let data = xhr.response;

                if(data == "success") {
                    window.location.href="user.php"
                } else {
                    errorTxt.textContent = data;
                    errorTxt.style.display = "block";
                }
            }
        }
    }

    let formData = new FormData(form);

    xhr.send(formData);
}