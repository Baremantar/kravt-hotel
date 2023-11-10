<style>
            #block-search,
            #block-search * {
                box-sizing: border-box;
            }

            #block-search.main {
                max-width: 1110px;
                position: relative;
            }

            #block-search.main.sticky-element {
                max-width: unset;
            }

            #block-search {
                background: transparent;
                width: 100%;
            }

            .tl-container {
                width: 100%;
            }
    </style>
    
    <?php
    $bookingId = '';
    switch (get_site()->blog_id) {
            case 1:
                break;
            case 2:
                $bookingId = '.21849';
                break;
            case 3:
                $bookingId = '.18115';
                break;
            case 4:
                $bookingId = '.11535';
                break;
            case 5:
                $bookingId = '.5128';
                break;
    } ?>


    <script type='text/javascript'>
            (function(w) {
                var q = [
                    ['setContext', 'TL-INT-kravt-affarts-dev_2022-08-30<?= $bookingId ?>', 'ru'],
                    ['embed', 'search-form', {
                        container: 'tl-search-form'
                    }]
                ];
                var h = ["ru-ibe.tlintegration.ru", "ibe.tlintegration.ru", "ibe.tlintegration.com"];
                var t = w.travelline = (w.travelline || {}),
                    ti = t.integration = (t.integration || {});
                ti.__cq = ti.__cq ? ti.__cq.concat(q) : q;
                if (!ti.__loader) {
                    ti.__loader = true;
                    var d = w.document,
                        c = d.getElementsByTagName("head")[0] || d.getElementsByTagName("body")[0];

                    function e(s, f) {
                        return function() {
                            w.TL || (c.removeChild(s), f())
                        }
                    }

                    (function l(h) {
                        if (0 === h.length) return;
                        var s = d.createElement("script");
                        s.type = "text/javascript";
                        s.async = !0;
                        s.src = "https://" + h[0] + "/integration/loader.js";
                        s.onerror = s.onload = e(s, function() {
                            l(h.slice(1, h.length))
                        });
                        c.appendChild(s)
                    })(h);
                }
            })(window);
          /*  window.onload = () => {
                document.querySelector('#tl-search-form iframe').contentWindow.document.querySelectorAll('select')[0].value = 5128;
            }*/
    </script>