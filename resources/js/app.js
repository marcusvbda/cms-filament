import 'bootstrap';
import Swiper from 'swiper'
import { Autoplay } from 'swiper/modules';
window.window.Swiper = Swiper;
window.window.Swiper.use([Autoplay]);

import AOS from 'aos';
AOS.init({
    duration: 500,
    once: true
});