// Import our CSS
import styles from '../css/app.scss';

//import (/* webpackChunkName: "jqueryscripts" */ './scripts.js');
import (/* webpackChunkName: "lazyloadpoly" */ 'lazysizes');

// App main
const main = async () => {
    // Async load the vue module
    const { default: Vue } = await import(/* webpackChunkName: "vue" */ 'vue');
    // Create our vue instance
    const vm = new Vue({
        el: "main",
        components: {
            //'component': () => import(/* webpackChunkName: "component" */ './modules/component.vue'),
        }
    });

    return vm;
};

// Execute async function
main().then( (vm) => {
    // Reinitialize freeform
    // This fixes an issue where freeform was added before vue initialized
    // but after vue initializes, freeform is removed.
    // So we just reinitialize it after Vue.
    if("undefined"!=typeof Freeform){
        let forms = document.querySelectorAll('form[data-ajax]');

        forms.forEach((form) => {
            new Freeform(form,{
                ajax:null!==form.getAttribute("data-ajax"),
                scrollToAnchor:form.getAttribute("data-scroll-to-anchor"),
                disableSubmit:null!==form.getAttribute("data-disable-submit"),
                hasRules:null!==form.getAttribute("data-has-rules")
            })
        })
    }
});

// Accept HMR as per: https://webpack.js.org/api/hot-module-replacement#accept
if (module.hot) {
    module.hot.accept();
}
