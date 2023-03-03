import './bootstrap';

import 'animate.css';
import '~css/app.scss';
import WOW from 'wow.js';
import './alpine';
// Import all of Bootstrap's JS
import 'bootstrap';

(() => {
    new WOW().init();
})();


(() => {
    if (document.querySelector('.hero-slider')) {
    //========= Hero Slider 
        window.tns({
            container: '.hero-slider',
            slideBy: 'page',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 0,
            items: 1,
            nav: false,
            controls: true,
            controlsText: ['<i class="lni lni-chevron-left"></i>', '<i class="lni lni-chevron-right"></i>'],
        });
    }

    if (document.querySelector('.brands-logo-carousel')) {
    //======== Brand Slider
        window.tns({
            container: '.brands-logo-carousel',
            autoplay: true,
            autoplayButtonOutput: false,
            mouseDrag: true,
            gutter: 15,
            nav: false,
            controls: false,
            responsive: {
                0: {
                    items: 1,
                },
                540: {
                    items: 3,
                },
                768: {
                    items: 5,
                },
                992: {
                    items: 6,
                }
            }
        });    
    }


})();

(() => {
    const header = document.querySelector('header.header');
    const headerTopBar = header.querySelector('.topbar');
  
    const MARGE = 5;

    if (!header || !headerTopBar) {
        return;
    }
    document.addEventListener('scroll', () => {
        if (window.scrollY > headerTopBar.scrollTop + headerTopBar.scrollHeight + MARGE) {
            headerTopBar.classList.add('d-none');
            header.classList.add('sticky-top');
        } else {
            headerTopBar.classList.remove('d-none');
            header.classList.remove('sticky-top');
        }
    });
})();




/*
Template Name: ShopGrids - Bootstrap 5 eCommerce HTML Template.
Author: GrayGrids
*/

(() => {
    //===== Prealoder

    window.onload =  () =>    {
        window.setTimeout(fadeout, 500);
    };

    const fadeout = () => {
        document.querySelector('.preloader').style.opacity = '0';
        document.querySelector('.preloader').style.display = 'none';
    };


    /*=====================================
  Sticky
  ======================================= */
    document.addEventListener('scroll', () => {
    // show or hide the back-top-top button
        var backToTo = document.querySelector('.scroll-top');
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            backToTo.style.display = 'flex';
        } else {
            backToTo.style.display = 'none';
        }
    });

    //===== mobile-menu-btn
    let navbarToggler = document.querySelector('.mobile-menu-btn');
    navbarToggler?.addEventListener('click',  () => {
        navbarToggler.classList.toggle('active');
    });


})();

