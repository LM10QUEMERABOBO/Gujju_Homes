const togglePassword1 = document.querySelector("#togglePassword1");
        const togglePassword2 = document.querySelector("#togglePassword2");

        // togglePassword1.style.display = "none";
        // togglePassword2.style.display = "none";

        const password1 = document.querySelector("#password1");
        const password2 = document.querySelector("#password2");

        let count1 = 0;
        let count2 = 0;

        function showEye1() {
            togglePassword1.style.display = "inline-block";
        }

        function showEye2() {
            togglePassword2.style.display = "inline-block";
        }

        togglePassword1.addEventListener("click", function() {

            // toggle the type attribute
            const type = password1.getAttribute("type") === "password" ? "text" : "password";
            password1.setAttribute("type", type);

            if (count1 == 0) {
                togglePassword1.innerHTML = "visibility";
                count1++;
            } else {
                togglePassword1.innerHTML = "visibility_off";
                count1--;
            }

        });

        togglePassword2.addEventListener("click", function() {

            // toggle the type attribute
            const type = password2.getAttribute("type") === "password" ? "text" : "password";
            password2.setAttribute("type", type);

            if (count2 == 0) {
                togglePassword2.innerHTML = "visibility";
                count2++;
            } else {
                togglePassword2.innerHTML = "visibility_off";
                count2--;
            }

        });