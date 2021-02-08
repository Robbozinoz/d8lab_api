import Mmenu from './../../core/oncanvas/mmenu.oncanvas';
import options from './_options';
import { extendShorthandOptions } from './_options';
import * as DOM from '../../_modules/dom';
import { extend } from '../../_modules/helpers';

//	Add the options.
Mmenu.options.autoHeight = options;

export default function(this: Mmenu) {
    var options = extendShorthandOptions(this.opts.autoHeight);
    this.opts.autoHeight = extend(options, Mmenu.options.autoHeight);

    if (options.height != 'auto' && options.height != 'highest') {
        return;
    }

    const setHeight = (() => {
        const getCurrent = (): number => {
            var panel = DOM.children(this.node.pnls, '.mm-panel_opened')[0];

            if (panel) {
                panel = measurablePanel(panel);
            }

            //	Fallback, just to be sure we have a panel.
            if (!panel) {
                panel = DOM.children(this.node.pnls, '.mm-panel')[0];
            }

            return panel.scrollHeight;
        };

        const getHighest = (): number => {
            var highest = 0;
            DOM.children(this.node.pnls, '.mm-panel').forEach(panel => {
                panel = measurablePanel(panel);
                highest = Math.max(highest, panel.scrollHeight);
            });

            return highest;
        };

        const measurablePanel = (panel: HTMLElement): HTMLElement => {
            //	If it's a vertically expanding panel...
            if (panel.parentElement.matches('.mm-listitem_vertical')) {
                //	...find the first parent panel that isn't.
                panel = DOM.parents(panel, '.mm-panel').filter(
                    panel =>
                        !panel.parentElement.matches('.mm-listitem_vertical')
                )[0];
            }
            return panel;
        };

        return () => {
            if (this.opts.offCanvas && !this.vars.opened) {
                return;
            }

            var _hgh = 0;
            var _dif =
                this.node.menu.offsetHeight - this.node.pnls.offsetHeight;

            //	The "measuring" classname undoes some CSS to be able to measure the height.
            this.node.menu.classList.add('mm-menu_autoheight-measuring');

            //	Measure the height.
            if (options.height == 'auto') {
                _hgh = getCurrent();
            } else if (options.height == 'highest') {
                _hgh = getHighest();
            }

            //	Set the height.
            this.node.menu.style.height = _hgh + _dif + 'px';

            //	Remove the "measuring" classname.
            this.node.menu.classList.remove('mm-menu_autoheight-measuring');
        };
    })();

    //	Add the autoheight class to the menu.
    this.bind('initMenu:after', () => {
        this.node.menu.classList.add('mm-menu_autoheight');
    });

    if (this.opts.offCanvas) {
        //	Measure the height when opening the off-canvas menu.
        this.bind('open:start', setHeight);
    }

    if (options.height == 'highest') {
        //	Measure the height when initiating panels.
        this.bind('initPanels:after', setHeight);
    }

    if (options.height == 'auto') {
        //	Measure the height when updating listviews.
        this.bind('updateListview', setHeight);

        //	Measure the height when opening a panel.
        this.bind('openPanel:start', setHeight);
    }
}
