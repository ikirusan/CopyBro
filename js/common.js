// PAGE

var common = {

    init: function() {
        common.fade_in();
        add_event(window, 'scroll', common.fade_in);
    },

    fade_in: function() {
        const bottom = window.scroll_top() + window.innerHeight;
        qs_all('body .fade-in').forEach((el) => {
            if (el.offsetTop < bottom) {
                add_class(el, 'fading');
                remove_class_delayed(el, 'fading', 450);
                remove_class_delayed(el, 'fade-in', 450);
            }
        });
    },

}

add_event(document, 'DOMContentLoaded', common.init);