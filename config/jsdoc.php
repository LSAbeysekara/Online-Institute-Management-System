<script>
            
            let popup = document.getElementById("popup");

            function openPopup(){
                popup.classList.add("open-popup");
            }

            function closePopup(){
                popup.classList.remove("open-popup");
            }
            const sideMenu = document.querySelector("aside");
            const menuBtn = document.querySelector("#menu-btn");
            const closeBtn = document.querySelector("#close-btn");
            

            menuBtn.addEventListener("click", () => {
                sideMenu.style.display = 'block';
            })

            closeBtn.addEventListener("click", () => {
                sideMenu.style.display = 'none';
            })

            const themeToggler = document.querySelector(".theme-toggler");
            const darkThemeClass = 'dark-theme-variables';
            const activeThemeKey = 'activeTheme';

            const setThemePreference = (isDarkTheme) => {
                localStorage.setItem(activeThemeKey, isDarkTheme ? 'dark' : 'light');
            }

            const applyThemePreference = () => {
                const activeTheme = localStorage.getItem(activeThemeKey);
                if (activeTheme === 'dark') {
                    document.body.classList.add(darkThemeClass);
                    themeToggler.querySelector('span:nth-child(1)').classList.remove('active');
                    themeToggler.querySelector('span:nth-child(2)').classList.add('active');
                } else {
                    document.body.classList.remove(darkThemeClass);
                    themeToggler.querySelector('span:nth-child(1)').classList.add('active');
                    themeToggler.querySelector('span:nth-child(2)').classList.remove('active');
                }
            }

            themeToggler.addEventListener('click', () => {
                document.body.classList.toggle(darkThemeClass);
                themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
                themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');

                const isDarkTheme = document.body.classList.contains(darkThemeClass);
                setThemePreference(isDarkTheme);
            });

            document.addEventListener('DOMContentLoaded', () => {
                applyThemePreference();
            });






            var swiper = new Swiper(".slide-content", {
            slidesPerView: 3,
            centeredSlides: true,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                type: "fraction",
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            });
         
            var appendNumber = 4;
            var prependNumber = 1;
            document
            .querySelector(".prepend-2-slides")
            .addEventListener("click", function (e) {
                e.preventDefault();
                swiper.prependSlide([
                '<div class="swiper-slide">Slide ' + --prependNumber + "</div>",
                '<div class="swiper-slide">Slide ' + --prependNumber + "</div>",
                ]);
            });
            document
            .querySelector(".prepend-slide")
            .addEventListener("click", function (e) {
                e.preventDefault();
                swiper.prependSlide(
                '<div class="swiper-slide">Slide ' + --prependNumber + "</div>"
                );
            });
            document
            .querySelector(".append-slide")
            .addEventListener("click", function (e) {
                e.preventDefault();
                swiper.appendSlide(
                '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>"
                );
            });
            document
            .querySelector(".append-2-slides")
            .addEventListener("click", function (e) {
                e.preventDefault();
                swiper.appendSlide([
                '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>",
                '<div class="swiper-slide">Slide ' + ++appendNumber + "</div>",
                ]);
            });



            
        </script>