'use strict';

const Slider = (($) => {

    // const NAME = 'slider';
    const VERSION = '1.0-dev';
    // const EVENT_KEY = `.${bs.tab}`;

    // const Event = {
    //     HIDE: `hide${EVENT_KEY}`
    // };

    class Slider {

        constructor() {
            this.options = {};
        }

        get VERSION() {
            return VERSION;
        }

        get(data) {
            return $(data);
        }

        set settings(options) {
            this.options = options;
            new this(this.options);
        }
    }

    return Slider;

})(jQuery);

export default Slider;
