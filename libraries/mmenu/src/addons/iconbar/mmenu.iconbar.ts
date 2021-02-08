import Mmenu from '../../core/oncanvas/mmenu.oncanvas';
import options from './_options';
import { extendShorthandOptions } from './_options';
import * as DOM from '../../_modules/dom';
import * as media from '../../_modules/matchmedia';
import { type, extend } from '../../_modules/helpers';

//  Add the options.
Mmenu.options.iconbar = options;

export default function (this: Mmenu) {
    let options = extendShorthandOptions(this.opts.iconbar);
    this.opts.iconbar = extend(options, Mmenu.options.iconbar);

    if (!options.use) {
        return;
    }

    let iconbar: HTMLElement;

    ['top', 'bottom'].forEach((position, n) => {
        let ctnt = options[position];

        //	Extend shorthand options
        if (type(ctnt) != 'array') {
            ctnt = [ctnt];
        }

        //	Create node
        const part = DOM.create('div.mm-iconbar__' + position);

        //	Add content
        for (let c = 0, l = ctnt.length; c < l; c++) {
            if (typeof ctnt[c] == 'string') {
                part.innerHTML += ctnt[c];
            } else {
                part.append(ctnt[c]);
            }
        }

        if (part.children.length) {
            if (!iconbar) {
                iconbar = DOM.create('div.mm-iconbar');
            }
            iconbar.append(part);
        }
    });

    //	Add to menu
    if (iconbar) {
        //	Add the iconbar.
        this.bind('initMenu:after', () => {
            this.node.menu.prepend(iconbar);
        });

        //	En-/disable the iconbar.
        let classname = 'mm-menu_iconbar-' + options.position;
        let enable = () => {
            this.node.menu.classList.add(classname);
            Mmenu.sr_aria(iconbar, 'hidden', false);
        };
        let disable = () => {
            this.node.menu.classList.remove(classname);
            Mmenu.sr_aria(iconbar, 'hidden', true);
        };

        if (typeof options.use == 'boolean') {
            this.bind('initMenu:after', enable);
        } else {
            media.add(options.use, enable, disable);
        }

        //	Tabs
        if (options.type == 'tabs') {
            iconbar.classList.add('mm-iconbar_tabs');
            iconbar.addEventListener('click', (evnt) => {
                const anchor = evnt.target as HTMLElement;

                if (!anchor.matches('a')) {
                    return;
                }

                if (anchor.matches('.mm-iconbar__tab_selected')) {
                    evnt.stopImmediatePropagation();
                    return;
                }

                try {
                    const panel = this.node.menu.querySelector(
                        anchor.getAttribute('href')
                    )[0];

                    if (panel && panel.matches('.mm-panel')) {
                        evnt.preventDefault();
                        evnt.stopImmediatePropagation();

                        this.openPanel(panel, false);
                    }
                } catch (err) {}
            });

            const selectTab = (panel: HTMLElement) => {
                DOM.find(iconbar, 'a').forEach((anchor) => {
                    anchor.classList.remove('mm-iconbar__tab_selected');
                });

                var anchor = DOM.find(iconbar, '[href="#' + panel.id + '"]')[0];
                if (anchor) {
                    anchor.classList.add('mm-iconbar__tab_selected');
                } else {
                    let parent: HTMLElement = panel['mmParent'];
                    if (parent) {
                        selectTab(parent.closest('.mm-panel') as HTMLElement);
                    }
                }
            };
            this.bind('openPanel:start', selectTab);
        }
    }
}
