<style>
    .tl-booking-container {
        max-width: 1640px;
        margin: 0 auto;
    }

    .bookmarks {
        padding: 0;
        list-style: none;
        display: flex;
        justify-content: space-between;
        margin: 0;
    }

    .bookmarks p {
        padding: 0 10px;
        margin: 0 auto;
        font-family: 'Montserrat', sans-serif;
        font-style: normal;
        font-weight: 600;
        font-size: 23px;
        line-height: 28px;
        color: #414141;
    }

    .bookmarks li.active {
        text-decoration: none;
        cursor: default;
        background: #0A0A0A;
        box-sizing: border-box;
    }

    .bookmarks li.active p {
        color: #FFFFFF;
    }

    .bookmarks li {
        cursor: pointer;
        height: 68px;
        display: flex;
        align-items: center;
        max-width: 368px;
        width: 100%;
        margin-right: 21px;
        background: #E0DEDD;
    }

    .bookmarks li:last-child {
        margin-right: 0;
    }


    #tl-hotel-select {
        display: none;
    }

    @media(max-width: 480px) {
        .bookmarks {
            flex-direction: column;
        }

        .bookmarks li {
            margin-top: 10px;
            max-width: 100%;
            margin-right: 0;
        }
    }

</style>
<!-- start TL Booking form script -->

<script type='text/javascript'>
    var select = document.getElementById("tl-hotel-select");
    select.addEventListener('change', function () {
        var hotel_id = "hotel_id";
        var regex = new RegExp(/hotel_id=\d+/g);
        var getParams = window.location.search;
        var params_str = hotel_id + "=" + this.value;
        var path = "";
        if (getParams.indexOf(hotel_id) != -1) {
            path = getParams.replace(regex, params_str);
        } else {
            if (getParams == "") {
                path = getParams + '?' + params_str;
            } else {
                path = getParams + '&' + params_str;
            }
        }
        window.history.pushState(false, false, path);
    });

    document.addEventListener('DOMContentLoaded', function(){    
        function getParameterByName(name, url) {
            if (!url) {
                url = window.location.href;
            }
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        var bookmarksElements = document.querySelectorAll('.bookmarks li');
        if (bookmarksElements != null) {
            for (var i = bookmarksElements.length - 1; i >= 0; i--) {
                var elem = bookmarksElements[i];
                (function(elem){
                    var prov = getParameterByName('hotel_id');
                    var el = elem.getAttribute('id');
                    if(document.getElementById(el).getAttribute('data-id') === prov) {
                        document.getElementById(el).classList.add('active');
                    }
                    else {
                        document.getElementById(el).classList.remove('active');
                    }

                    if((prov === 0) || (prov == null) || (prov === '0')) {
                        document.getElementById("hotel-1").classList.add('active');
                    }
                })(elem)
            }
        };

        var selector = document.getElementById('tl-hotel-select'),
            listElement = document.querySelectorAll('.bookmarks li[id ^="hotel-"]');

        if (listElement != null) {

            for (var i = listElement.length - 1; i >= 0; i--) {
                var elem = listElement[i];
                (function(elem){
                    elem.addEventListener("click", function () {
                        var listActiveElement = document.querySelector('.bookmarks li.active'),
                            data_id = document.getElementById(elem.getAttribute('id')).getAttribute('data-id');

                        listActiveElement.classList.remove('active');
                        document.getElementById(elem.getAttribute('id')).classList.add('active');
                        selector.value = data_id;
                        fireEvent(selector[0], 'change');
                    });
                })(elem)
            }
        };

        function fireEvent(element, event) {
            if (document.createEventObject) {
                var ieEvt = document.createEventObject();
                return element.fireEvent('on' + event, ieEvt);
            }
            else {
                var evt = document.createEvent("HTMLEvents");
                evt.initEvent(event, true, true);
                return !element.dispatchEvent(evt);
            }
        }
    });

    (function(w) {
        var q = [
            ['setContext', 'TL-INT-kravt-affarts-dev_2022-08-30', 'ru'],
            ['embed', 'booking-form', {
                container: 'tl-booking-form'
            }]
        ];
        var h=["ru-ibe.tlintegration.ru","ibe.tlintegration.ru","ibe.tlintegration.com"];
        var t = w.travelline = (w.travelline || {}),
            ti = t.integration = (t.integration || {});
        ti.__cq = ti.__cq? ti.__cq.concat(q) : q;
         if (!ti.__loader) {
          ti.__loader = true;
          var d=w.document,c=d.getElementsByTagName("head")[0]||d.getElementsByTagName("body")[0];
          function e(s,f) {return function() {w.TL||(c.removeChild(s),f())}}
          (function l(h) {
              if (0===h.length) return; var s=d.createElement("script");
              s.type="text/javascript";s.async=!0;s.src="https://"+h[0]+"/integration/loader.js";
              s.onerror=s.onload=e(s,function(){l(h.slice(1,h.length))});c.appendChild(s)
          })(h);
      }
    })(window);
</script>
<!-- end TL Booking form script -->