const elem = (id) => document.getElementById(id);
const nearMarkers = document.getElementsByClassName("kravt_kazan_near-marker");

const pages = ["Hotel Kazan"];
let allowClose;
let current = 0;
let currentScene = 0;
let spa_count = 1;
let currentGroupSlide = 0;
let startProgress = 0;
let active = elem("spa_1");
let toTranslate = 1;

const titleData = {
  restaraunts: "Рестораны",
  main: "Kravt Home",
  kazan: "Kravt Kazan",
};

const burgerHoverItems = [
  "hotel-albora",
  "hotel-nevsky",
  "hotel-sadovaya",
  "hotel-kazan",
  "hotel-innopolis",
];

let headerHeight = {};
headerHeight.onScroll = "80px";
headerHeight.static = "120px";

// waiter function

function waitForElm(selector) {
  return new Promise((resolve) => {
    if (document.querySelector(selector)) {
      return resolve(document.querySelector(selector));
    }

    const observer = new MutationObserver((mutations) => {
      if (document.querySelector(selector)) {
        resolve(document.querySelector(selector));
        observer.disconnect();
      }
    });

    observer.observe(document.body, {
      childList: true,
      subtree: true,
    });
  });
}

if (document.querySelector("#block-search")) {
  waitForElm(".sf-wrapper").then((elem) => {
    console.log("load");
  });
  if (
    // document.documentElement.clientWidth > 930 &&
    document.location.pathname == "/"
  ) {
    let cond = {};
    let d = document;
    var newEl = d.createElement("span");
    newEl.classList.add("myObserver");

    var ref = d.querySelector("#block-search");
    insertBefore(newEl, ref);
    function insertBefore(el, referenceNode) {
      referenceNode.parentNode.insertBefore(el, referenceNode);
    }
    cond.head = "#block-search";
    var observer = new IntersectionObserver(
      function (entries) {
        if (entries[0].intersectionRatio === 0) {
          d.querySelector(cond.head).classList.add("sticky-element");
        } else if (entries[0].intersectionRatio === 1) {
          d.querySelector(cond.head).classList.remove("sticky-element");
        }
      },
      { threshold: [0, 1] }
    );

    observer.observe(d.querySelector(".myObserver"));
  } else if (
    document.documentElement.clientWidth > 930 &&
    document.location.pathname != "gallery"
  ) {
    headerHeight.onScroll = "fit-content";
    headerHeight.static = "60px";
  } else {
  }
}
if (document.getElementById("toTop")) {
  addEventListener("scroll", (event) => {
    if (this.scrollY > window.innerHeight) {
      document.getElementById("toTop").classList.add("visible");
      if (
        this.scrollY >=
        document.body.scrollHeight - window.innerHeight - 250
      ) {
        document.getElementById("toTop").classList.remove("visible");
      }
    } else {
      document.getElementById("toTop").classList.remove("visible");
    }
  });

  document.getElementById("toTop").addEventListener("click", (event) => {
    window.scrollTo(0, 0);
  });
}

const get = (condition, value) => {
  switch (condition) {
    case "query":
      return document.querySelector(value);
      break;
    case "queryAll":
      return document.querySelectorAll(value);
      break;
    case "id":
      return document.getElementById(value);
      break;
    case "classes":
      return document.getElementsByClassName(value);
      break;
  }
};

const markersPosition = [
  {
    top: 124,
    left: -836,
  },
  {
    top: 139,
    left: 679,
  },
  {
    top: 362,
    left: 0,
  },
  {
    top: 500,
    left: -1086,
  },
  {
    top: 619,
    left: 838,
  },
];

const states = {
  burgered: false,
  togglingElements: ["header_picker", "navigation_links"],
  container: {
    visibility: {
      on: "visible",
      off: "hidden",
    },
    opacity: {
      on: "1",
      off: "0",
    },
  },
  header: {
    visibility: {
      on: "hidden",
      off: "visible",
    },
    opacity: {
      on: "0",
      off: "1",
    },
  },
  phoneBtn: {
    className: {
      on: "kravt_hero_phone-button-burgered",
      off: "kravt_hero_phone-button rounded white_blur",
    },
  },
  toggleIcon: {
    src: {
      on: `${window.location.origin}/wp-content/themes/kravt-hotels/build/img/icons/close_icon.svg`,
      off: `${window.location.origin}/wp-content/themes/kravt-hotels/build/img/icons/burger.svg`,
    },
  },
};

const groupSlides = [];

const pageIs = (page) => {
  return document.title === page;
};

class KravtApp {
  constructor(state) {
    this.state = state;
    this.pages = state.pages;
  }
  onPage(page, handler) {
    if (document.title === page) handler();
  }
  onPages(pages, handler) {
    for (let i = 0; i < pages.length; i++) {
      if (document.title === pages[i]) handler();
    }
  }
}

function wrap(elems) {
  const wrapper = document.createElement("div");
  wrapper.className = "kravt_wrapbox";
  el.parentNode.insertBefore(wrapper, el);
  wrapper.appendChild(el);
}

const app = new KravtApp({
  userData: {
    hotel: "",
    date: "",
    guests: {
      adult: 2,
      kids: 2,
    } /* 0 - взрослые, 1 - дети */,
  },
  appData: {
    group: {
      groupSlides,
    },
  },
  pages: {
    home: "Kravt Hotels",
    kazan: "Kravt Hotel Kazan Airport",
    nevsky: "Kravt Nevsky Hotel & Spa",
    albora: "Albora Boutique Hotel",
    sadovaya: "Kravt Sadovaya Hotel",
    gallery: "Галерея",
  },
  container: {
    visibility: {
      on: "visible",
      off: "hidden",
    },
    classNames: {
      on: "kravt-container-active",
      off: "kravt-container-default",
    },
  },
});

/* Home page */
app.onPage(app.pages.home, () => {
  const links = get("classes", "event-link-handle");
  for (let i = 0; i < links.length; i++) {
    links[i].onclick = (event) => {
      event.preventDefault();
      Array.from(document.getElementsByClassName("event-current-img")).forEach(
        (element) => {
          element.style.display = "none";
        }
      );
      get("id", `event-current-img-${i}`).style.display = `flex`;
      links[eventLinkActive].className = "kravt_events_link event-link-handle";
      links[i].className = "kravt_events_link-active event-link-handle";
      eventLinkActive = i;
      get("query", ".kravt_events_link-more").href = links[i].href;
    };
  }
});

/* Burger menu hover bg */
for (let i = 0; i < burgerHoverItems.length; i++) {
  if (elem(burgerHoverItems[i])) {
    elem(burgerHoverItems[i]).onmouseover = () => {
      elem("burger_container").style.backgroundImage = `url('${
        window.location.origin
      }/wp-content/themes/kravt-hotels/build/img/backgrounds/bg-${
        i + 1
      }.webp')`;
    };
    elem(burgerHoverItems[i]).onmouseleave = () => {
      elem(
        "burger_container"
      ).style.backgroundImage = `url('${window.location.origin}/wp-content/themes/kravt-hotels/build/img/backgrounds/bg.webp')`;
    };
  }
}

var separate = window.location.host.split(".");
separate.shift();
var currentdomain = separate.join(".");

/* Restaraunts init */
if (
  (window.location.pathname.split("/").length >= 3 &&
    window.location.pathname.split("/")[1] == "restaraunts") ||
  (window.location.pathname.split("/").length > 3 &&
    window.location.pathname.split("/")[1] == "offers") ||
  (window.location.pathname.split("/").length > 3 &&
    window.location.pathname.split("/")[1] == "services") ||
  (window.location.pathname.split("/").length > 3 &&
    window.location.pathname.split("/")[1] == "events")
) {
  document.addEventListener("click", (event) => {
    if (event.target.classList.contains("_booking-link")) {
      document.querySelector(
        ".kravt_restaraunts_mask:not(.full)"
      ).style.visibility = "visible";
      document.querySelector(
        ".kravt_restaraunts_mask:not(.full)"
      ).style.opacity = "1";
    }
  });

  let allowClose = true;
  document.querySelector(
    ".kravt_restaraunts_mask:not(.full) #mask_content"
  ).onmouseover = () => {
    allowClose = false;
  };
  document.querySelector(
    ".kravt_restaraunts_mask:not(.full) #mask_content"
  ).onmouseleave = () => {
    allowClose = true;
  };
  document.querySelector(".kravt_restaraunts_mask:not(.full)").onclick = () => {
    if (allowClose) {
      document.querySelector(
        ".kravt_restaraunts_mask:not(.full"
      ).style.visibility = "hidden";
      document.querySelector(
        ".kravt_restaraunts_mask:not(.full"
      ).style.opacity = "0";
    }
  };
  const picker = new easepick.create({
    element: "#datepicker_restaraunts",
    css: [
      `${window.location.origin}/wp-content/themes/kravt-hotels/build/css/easepick.min.css`,
    ],
    zIndex: 10,
    autoApply: false,
    lang: "ru-RU",
    format: "DD MMM YYYY, HH:mm",
    TimePlugin: {
      stepMinutes: 1,
    },
    plugins: ["TimePlugin"],
  });
}
var data = [];

if (document.querySelector(".kravt_restaraunts_mask.full")) {
  Array.from(document.querySelectorAll("a"), (element) => {
    if (element.text == "Управление") {
      element.style.cursor = "point";
      // element.addEventListener("click", (event) => {
      //   event.preventDefault();

      //   if (element.classList.contains("kravt_burger_down-link")) {
      //     checkState();
      //   }

      //   document.querySelector(
      //     ".kravt_restaraunts_mask.full"
      //   ).style.visibility = "visible";
      //   document.querySelector(".kravt_restaraunts_mask.full").style.opacity =
      //     "1";
      // });
    }
  });
}

if (document.querySelector(".kravt_restaraunts_mask")) {
  Array.from(document.querySelectorAll("form#mask_content"), (element) => {
    var phoneMask = IMask(element.querySelector('input[type="tel"]'), {
      mask: "+{7} (000) 000-00-00",
    });

    element.addEventListener("submit", (e) => {
      e.preventDefault();
      const formData = new FormData(e.target);

      if (e.target.classList.contains("bigger")) {
        formData.append("formType", "main");
        formData.append(
          "departmentName",
          e.target.querySelector("select").options[
            e.target.querySelector("select").selectedIndex
          ].text
        );
      } else {
        formData.append("formType", element.dataset.typemodal);
        formData.append("hotel", element.dataset.hotel);
        formData.append("title", element.dataset.title);
      }

      $.ajax({
        type: "POST", //Метод отправки
        url: window.location.origin + "/mail.php", //путь до php фаила отправителя
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function (data) {
          // сoбытиe пoслe удaчнoгo oбрaщeния к сeрвeру и пoлучeния oтвeтa
          e.target.style.display = "none";
          e.target.parentElement
            .querySelector(".kravt-submit")
            .classList.toggle("active");
        },
      });
    });
    element.parentElement
      .querySelector(".kravt-submit button")
      .addEventListener("click", (e) => {
        e.target.parentElement.parentElement.querySelector(
          "#mask_content"
        ).style.display = "flex";

        e.target.parentElement.parentElement.style.visibility = "0";
        e.target.parentElement.parentElement.style.opacity = "0";
        setTimeout(() => {
          e.target.parentElement.classList.toggle("active");
        }, 1000);
      });

    element.parentElement.addEventListener("click", (event) => {
      if (event.target.id == "mask_container") {
        event.target.style.visibility = "";
        event.target.style.opacity = "";

        document.querySelector('.kravt_hero_container').removeAttribute('style');
      }
    });
  });

  Array.from(document.querySelectorAll("._booking-link.custom"), (elem) => {
    elem.addEventListener("click", (event) => {
      document.querySelector(".kravt_restaraunts_mask").style.visibility =
        "visible";
      document.querySelector(".kravt_restaraunts_mask").style.opacity = "1";

      document.querySelector('.kravt_hero_container').style.zIndex = '105';
    });
  });
}

/* Main pages init */

let eventLinkActive = 0;

// method onPages (beta)

app.onPages(
  [
    app.pages.main,
    app.pages.kazan,
    app.pages.nevsky,
    app.pages.albora,
    app.pages.sadovaya,
  ],
  () => {
    for (
      let i = 0;
      i < document.getElementsByClassName("_booking-link").length;
      i++
    ) {
      document.getElementsByClassName("_booking-link")[i].onclick = () => {
        elem("mask_container").style.visibility = "visible";
        elem("mask_container").style.opacity = "1";
      };
    }
    let allowClose = true;
    elem("mask_content").onmouseover = () => {
      allowClose = false;
    };
    elem("mask_content").onmouseleave = () => {
      allowClose = true;
    };
    elem("mask_container").onclick = () => {
      if (allowClose) {
        elem("mask_container").style.visibility = "hidden";
        elem("mask_container").style.opacity = "0";
      }
    };
    const picker = new easepick.create({
      element: "#datepicker_restaraunts",
      css: [
        `${window.location.origin}/wp-content/themes/kravt-hotels/build/css/easepick.min.css`,
      ],
      zIndex: 10,
      autoApply: false,
      lang: "ru-RU",
      format: "DD MMM YYYY, HH:mm",
      TimePlugin: {
        stepMinutes: 1,
      },
      plugins: ["TimePlugin"],
    });
  }
);

/* kazan.html infinite slider */

if (document.querySelector(".kravt_group_slider-item")) {
  var groupItems = [...document.getElementsByClassName("kravt_group_slider-item")]; // var для Safari
  groupItems[currentGroupSlide].style.color = "black";
  changeSlide();
  setInterval(() => {
    if (startProgress <= 100) {
      elem("progress_current").style.width = startProgress + "%";
      startProgress += 0.3125;
    } else {
      changeSlide(currentGroupSlide);
    }
  }, 31.25);
  function changeSlide(prev) {
    if (currentGroupSlide < groupItems.length) {
      startProgress = 0;
      elem("group_slide_title-mobile").innerHTML = document.querySelector(
        '#group-slide-' + currentGroupSlide
      ).outerText;

      elem("group_slide_title").innerHTML = document.querySelector(
        '#group-slide-' + currentGroupSlide
      ).outerText;
      elem("group_slide_desc").innerHTML = document.querySelector('#group-slide-' + currentGroupSlide).getAttribute("data-description");
      elem("group_slide_img").style.opacity = "0";
      elem("group_slide_img").style.backgroundImage = 'url("' + document.querySelector('#group-slide-' + currentGroupSlide).getAttribute("data-background") + '")';
      elem("group_slide_img-mobile").style.opacity = "0";
      elem("group_slide_img-mobile").style.backgroundImage = 'url("' + document.querySelector('#group-slide-' + currentGroupSlide).getAttribute("data-background") + '")';
      setTimeout(() => {
        elem("group_slide_img").style.opacity = "1";
        elem("group_slide_img-mobile").style.opacity = "1";
      }, 200);

      for (
        let i = 0;
        i < document.querySelectorAll(".kravt_group_slider-items span").length;
        i++
      ) {
        groupItems[i].style.color = "#BCBCBF";
      }
      if (currentGroupSlide === 0) {
        groupItems[0].style.color = "black";
      } else {
        groupItems[currentGroupSlide].style.color = "black";
      }
      currentGroupSlide++;
    } else {
      currentGroupSlide = 0;
    }
  }

  for (let i = 0; i <= groupItems.length - 1; i++) {
    groupItems[i].onclick = () => {
      currentGroupSlide = i;
      changeSlide();
    };
  }
}

/* Custom swiper for index.html */

/* Page gallery.html init */

var galleryPopup = () => {
  const scenes = document.getElementsByClassName("kravt_gallery_grid");
  const links = document.getElementsByClassName("kravt_gallery_menu-item");
  const links_mobile = document.getElementsByClassName(
    "kravt_gallery_menu-mobile-item"
  );
  const galleryItems = document.getElementsByClassName("kravt_gallery_item");

  const galleryTitles = Array.from(galleryItems).map((element) => element.alt);

  for (let i = 0; i < scenes.length; i++) {
    links_mobile[i].onclick = (e) => {
      e.preventDefault();
      scenes[currentScene].style.display = "none";
      links_mobile[i].className =
        "kravt_gallery_menu-mobile-active kravt_gallery_menu-mobile-item";
      links_mobile[currentScene].className = "kravt_gallery_menu-mobile-item";
      links[i].className = "kravt_gallery_menu-active kravt_gallery_menu-item";
      links[currentScene].className = "kravt_gallery_menu-item";
      currentScene = i;
      scenes[currentScene].style.display = "grid";
      document.querySelector("#loadMore").style.display = "flex";
    };
    links[i].onclick = (e) => {
      e.preventDefault();
      scenes[currentScene].style.display = "none";
      links_mobile[i].className =
        "kravt_gallery_menu-mobile-active kravt_gallery_menu-mobile-item";
      links_mobile[currentScene].className = "kravt_gallery_menu-mobile-item";
      links[i].className = "kravt_gallery_menu-active kravt_gallery_menu-item";
      links[currentScene].className = "kravt_gallery_menu-item";
      currentScene = i;
      scenes[currentScene].style.display = "grid";
      document.querySelector("#loadMore").style.display = "flex";
    };
  }
  elem("mask_content").onmouseover = () => {
    allowClose = false;
  };
  elem("mask_content").onmouseleave = () => {
    allowClose = true;
  };
  elem("gallery_close").onclick = () => {
    elem("gallery_opened").style.visibility = "hidden";
    elem("gallery_opened").style.opacity = "0";
  };
  elem("gallery_opened").onclick = () => {
    if (allowClose) {
      elem("gallery_opened").style.visibility = "hidden";
      elem("gallery_opened").style.opacity = "0";
    }
  };
  elem("gallery-prev").onclick = () => {
    if (current >= 1) {
      current -= 1;
      elem("opened_img").src = galleryItems[current].src;
      elem(
        "opened_div"
      ).style.backgroundImage = `url(${galleryItems[current].src})`;
      elem("gallery_opened_title").innerHTML = galleryTitles[current];
    } else {
      elem("opened_img").src = galleryItems[galleryItems.length - 1].src;
      elem(
        "opened_div"
      ).style.backgroundImage = `url(${galleryItems[current].src})`;

      current = galleryItems.length - 1;
      elem("gallery_opened_title").innerHTML =
        galleryTitles[galleryItems.length - 1];
    }
  };

  elem("gallery-next").onclick = () => {
    if (current <= galleryItems.length - 2) {
      current += 1;
      elem("opened_img").src = galleryItems[current].src;
      elem(
        "opened_div"
      ).style.backgroundImage = `url(${galleryItems[current].src})`;
      elem("gallery_opened_title").innerHTML = galleryTitles[current];
    } else {
      elem("opened_img").src = galleryItems[0].src;
      elem(
        "opened_div"
      ).style.backgroundImage = `url(${galleryItems[current].src})`;
      elem("gallery_opened_title").innerHTML = galleryTitles[0];
      current = 0;
    }
  };

  for (let i = 0; i < galleryItems.length; i++) {
    galleryItems[i].id = `gallery-elem-${i}`;
    galleryItems[i].onclick = () => {
      elem(
        "opened_div"
      ).style.backgroundImage = `url(${galleryItems[current].src})`;
      elem("opened_img").src = galleryItems[i].src;
      elem("gallery_opened_title").innerHTML = galleryTitles[i];
      elem("gallery_opened").style.visibility = "visible";
      elem("gallery_opened").style.opacity = "1";
      current = i;
    };
  }
};

app.onPage(app.pages.gallery, () => {
  galleryPopup();
});

/* Scroll controllers */

const clearScroll = () => {
  elem("kravt_header").style.background = "none";
  elem("kravt_header").style.backdropFilter = "none";
  elem("kravt_header").className = "kravt_header";
  elem("navbar_darked") ? (elem("navbar_darked").style.display = "block") : "";
  elem("kravt_header").style.boxShadow = "none";
  elem("kravt_header").style.height = headerHeight.static;
};

const setScroll = () => {
  elem("kravt_header").style.background =
    document.title == "Gallery" ? "#f3f2f1" : "rgba(243, 242, 241, 0.8)";
  elem("navbar_darked") ? (elem("navbar_darked").style.display = "none") : "";
  elem("kravt_header").style.backdropFilter =
    document.title == "Gallery" ? "none" : "blur(10px)";
  elem("kravt_header").className = "kravt_header kravt_header_scrolled";
  elem("kravt_header").style.height = headerHeight.onScroll;
};

/* Burger toggler */
function toggler(value) {
  if (document.querySelector(".kravt_dynamic_navigation")) {
    if (value) {
      document.querySelector(".kravt_dynamic_navigation").style.zIndex = "0";
    } else {
      document.querySelector(".kravt_dynamic_navigation").style.zIndex = "5";
    }
  }

  if (value) document.body.style.overflowY = "hidden";
  else document.body.style.overflowY = "auto";
  states.burgered = value;

  if (!value && window.scrollY > 0) setScroll();
  else if (value) clearScroll();
  for (
    let i = 0;
    i < document.getElementsByClassName("navbar_darked").length;
    i++
  ) {
    document.getElementsByClassName("navbar_darked")[i].style.display = value
      ? "none"
      : "block";
  }

  elem("burger_container").style.visibility = value
    ? states.container.visibility.on
    : states.container.visibility.off;
  elem("burger_container").style.opacity = value
    ? states.container.opacity.on
    : states.container.opacity.off;
  elem("header").style.display = value ? "none" : "flex";
  elem("header_burger").style.display = value ? "flex" : "none";
  elem("phone_button").className = value
    ? states.phoneBtn.className.on
    : states.phoneBtn.className.off;
  elem("burger_icon").src = value
    ? states.toggleIcon.src.on
    : states.toggleIcon.src.off;
  // elem("spa_current_img").style.zIndex = value ? "2" : "3";
}

function checkState() {
  if (states.burgered) {
    toggler(false);
  } else {
    toggler(true);
  }
}

const burger_mobile_links = document.querySelectorAll('.kravt_burger_mobile a');

burger_mobile_links.forEach(el => {
  el.addEventListener('click', e => {
    e.preventDefault();

    window.location.href = e.target.getAttribute('href');
    setTimeout('checkState', 1000);
  });
});

/* Accordion controller */

var acc = document.getElementsByClassName("kravt_kazan_faq_accordion");

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function () {
    /* Toggle between adding and removing the "active" class,
      to highlight the button that controls the panel */
    this.classList.toggle("faq_accordion_active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

var acc_burger = document.getElementsByClassName("accordion");

for (i = 0; i < acc_burger.length; i++) {
  acc_burger[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

for (let i = 0; i < nearMarkers.length; i++) {
  nearMarkers[i].style.marginTop = markersPosition[i].top + "px";
  nearMarkers[i].style.marginLeft = markersPosition[i].left + "px";
}

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function () {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

if (document.querySelector(".kravt_burger_mask")) {
  document.querySelector(".kravt_burger_mask").onscroll = () => {
    if (document.querySelector(".kravt_burger_mask").scrollTop >= 20) {
      elem("header_burger").style.background = "rgba(37, 35, 35, 0.1)";
      elem("header_burger").style.backdropFilter = "blur(12px)";
    } else {
      elem("header_burger").style.background = "none";
      elem("header_burger").style.backdropFilter = "none";
    }
  };
}

window.onscroll = () => {
  if (!states.burgered) {
    if (window.scrollY > 0) setScroll();
    else clearScroll();
  }

  if (window.location == window.location.origin + "/gallery/") {
    if (window.scrollY >= 350) {
      document.querySelector(".kravt_gallery_menu-mobile").style.opacity = "1";
      document.querySelector(".kravt_gallery_menu-mobile").style.visibility =
        "visible";
    } else {
      document.querySelector(".kravt_gallery_menu-mobile").style.opacity = "0";
      document.querySelector(".kravt_gallery_menu-mobile").style.visibility =
        "hidden";
    }
  }
};

const initMap = () => {
  const map = new mapboxgl.Map({
    container: "map",
    style: "mapbox://styles/danevans1/cl2g1b2xl00d617pre09qx8p2",
    center: center,
    zoom: zoom,
    cooperativeGestures: true,
  });

  map.addControl(new mapboxgl.NavigationControl());
  // map.scrollZoom.disable(); //zoom
  const geojson = {
    type: "FeatureCollection",
    nears: [
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.385378, 59.923599],
        },
        properties: {
          title: "П",
          description: "памятник Александру Невскому",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.388226, 59.921033],
        },
        properties: {
          title: "C",
          description: "Свято-Троицкая Александро-Невская Лавра",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.394809, 59.948861],
        },
        properties: {
          title: "В",
          description: "Воскресенский Смольный собор",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.375969, 59.947685],
        },
        properties: {
          title: "Т",
          description: "Таврический дворец",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.343392, 59.933194],
        },
        properties: {
          title: "А",
          description: "Аничков мост",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.343181, 59.934674],
        },
        properties: {
          title: "M",
          description: "Музей Фаберже",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.338029, 59.9417],
        },
        properties: {
          title: "Ч",
          description: "Чижик-Пыжик",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.332383, 59.938782],
        },
        properties: {
          title: "Р",
          description: "Русский музей, Михайловский дворец",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.328633, 59.94007],
        },
        properties: {
          title: "С",
          description: "Спас на Крови",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.324611, 59.934345],
        },
        properties: {
          title: "К",
          description: "Казанский кафедральный собор",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.300064, 59.922546],
        },
        properties: {
          title: "Н",
          description: "Николо-Богоявленский Морской собор",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.298731, 59.920958],
        },
        properties: {
          title: "С",
          description: "Семимостье",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.2973, 59.916911],
        },
        properties: {
          title: "Е",
          description: "Египетский мост",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.313025, 59.919597],
        },
        properties: {
          title: "П",
          description: "Петербургский ангел",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.29347, 59.929722],
        },
        properties: {
          title: "Ц",
          description: "Центральный военно-морской музей",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.296367, 59.925719],
        },
        properties: {
          title: "М",
          description: "Государственный академический Мариинский театр",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.298962, 59.929483],
        },
        properties: {
          title: "Ю",
          description: "Юсуповский дворец",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.306233, 59.934137],
        },
        properties: {
          title: "И",
          description: "Исаакиевский собор",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.304954, 59.926891],
        },
        properties: {
          title: "Г",
          description: "канал Грибоедова",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.30145, 59.926909],
        },
        properties: {
          title: "Л",
          description: "Львиный мост",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.331054, 59.927394],
        },
        properties: {
          title: "Б",
          description: "Большой драматический театр имени Г.А. Товстоногова",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.309779, 59.930635],
        },
        properties: {
          title: "М",
          description: "Мариинский дворец",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.333385, 59.934079],
        },
        properties: {
          title: "Д",
          description: "Дворцовая площадь",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.333385, 59.934079],
        },
        properties: {
          title: "Б",
          description: "Большой Гостиный Двор",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [49.29869291566038, 55.61161499875743],
        },
        properties: {
          title: "М",
          description: "МВЦ Казань Экспо",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [49.10517708338136, 55.79835060181236],
        },
        properties: {
          title: "М",
          description: "Мечеть Кул-Шариф",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [49.10517708338136, 55.79835060181236],
        },
        properties: {
          title: "М",
          description: "Мечеть Кул-Шариф",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [49.111939367620835, 55.80041989453807],
        },
        properties: {
          title: "Д",
          description: "Дворец Земледельцев",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [49.149036576117254, 55.79873322621921],
        },
        properties: {
          title: "Ц",
          description: "Центральный парк культуры и отдыха",
        },
      },
    ],
    features: [
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.324534, 59.930471],
        },
        properties: {
          title: "Kravt Sadovaya",
          description: "Hotel 0",
          link: "sadovaya",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.384071, 59.925944],
        },
        properties: {
          title: "Kravt Nevsky Hotel & SPA",
          description: "Hotel 1",
          link: "nevsky",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [30.296909, 59.921471],
        },
        properties: {
          title: "Albora Boutique",
          description: "Hotel 2",
          link: "albora",
        },
      },
      {
        type: "Feature",
        geometry: {
          type: "Point",
          coordinates: [49.30277799302306, 55.60970270966243],
        },
        properties: {
          title: "Kravt Hotel Kazan Airport",
          description: "Hotel 3",
          link: "kazan",
        },
      },
    ],
  };
  let markers = 0;
  for (const near of geojson.nears) {
    const el = document.createElement("div");
    el.className = `near`;
    el.innerHTML = near.properties.title;
    new mapboxgl.Marker(el)
      .setLngLat(near.geometry.coordinates)
      .setPopup(
        new mapboxgl.Popup({ offset: 25, closeButton: false }).setHTML(
          `<p>${near.properties.description}</p>`
        )
      )
      .addTo(map);
  }
  for (const feature of geojson.features) {
    const el = document.createElement("div");
    const urlParts = new URL(window.location.href).hostname.split(".");
    el.onclick = () =>
      // console.log(feature.properties.link)
      (window.location.href =
        window.location.origin.length > 2
          ? "http://" +
            feature.properties.link +
            "." +
            urlParts[1] +
            "." +
            urlParts[2]
          : "http://" +
            feature.properties.link +
            "." +
            urlParts[0] +
            "." +
            urlParts[1]);
    el.className = `marker marker_${markers}`;
    markers++;
    new mapboxgl.Marker(el).setLngLat(feature.geometry.coordinates).addTo(map);
  }
};

if (document.querySelector("#map")) {
  mapboxgl.accessToken =
    "pk.eyJ1IjoiZGFuZXZhbnMxIiwiYSI6ImNsMXZ3eG9oZzB1b3YzZHFvc3UxYjdxbXcifQ.RJkL2AqGZ1HluqqY18vZPQ";
  var center;
  var zoom;

  if (window.location.host.split(".")[0].indexOf("kazan") != 0) {
    center = [30.34106, 59.926036];
    zoom = 13;
  } else {
    center = [49.301, 55.614];
    zoom = 11.57;
  }

  initMap();
}

if (document.querySelector(".swiper")) {
  let swiperHotels = new Swiper(".mySwiper", {
    slidesPerView: "auto",
    loop: true,
    spaceBetween: 20,
    breakpoints: {
      1000: {
        slidesPerView: 3,
        centeredSlides: true,
        spaceBetween: 40,
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-nav-next-button",
      prevEl: ".swiper-nav-prev-button",
    },
  });

  let swiperHotelse = new Swiper(".mySwiperHotels", {
    slidesPerView: 1,
    loop: true,
    breakpoints: {
      1000: {
        slidesPerView: "auto",
        spaceBetween: 10,
      },
    },
    spaceBetween: 15,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next-el",
    },
  });

  let swiperOffers = new Swiper(".mySwiperOffers", {
    followFinger: true,
    slidesPerView: "auto",
    loop: true,
    spaceBetween: 22,
    breakpoints: {
      1000: {
        spaceBetween: 40,
      },
    },
    navigation: {
      nextEl: ".swiper-button-next-el",
    },
  });

  let swiperGroup = new Swiper(".mySwiperGroupProjects", {
    slidesPerView: "auto",
    loop: true,
    spaceBetween: 0,
    breakpoints: {
      1000: {
        spaceBetween: 92,
      },
    },
    navigation: {
      nextEl: ".swiper-button-next-el",
    },
  });

  let swiperRestaraunts = new Swiper(".mySwiperRestaraunts", {
    slidesPerView: 1,
    loop: true,
    spaceBetween: 20,
    // enabled: false,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      1000: {
        slidesPerView: "auto",
        spaceBetween: 40,
      },
    },
    navigation: {
      nextEl: ".swiper-nav-next-button",
      prevEl: ".swiper-nav-prev-button",
    },
  });

  let swiperRestarauntsKazan = new Swiper(".mySwiperRestarauntsKazan", {
    slidesPerView: 1,
    loop: true,
    spaceBetween: 20,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      1000: {
        slidesPerView: "auto",
        spaceBetween: 30,
      },
    },
    navigation: {
      nextEl: ".swiper-nav-next-button",
      prevEl: ".swiper-nav-prev-button",
    },
  });

  let swiperScreen = new Swiper(".mySwiperScreen", {
    slidesPerView: "auto",
    loop: true,
    // spaceBetween: 30,
    // enabled: false,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".kravt_screen-swiper-arrow",
      prevEl: ".swiper-nav-prev-button",
    },
  });

  let swiperEvents = new Swiper(".mySwiperKazanEvents", {
    slidesPerView: "auto",
    loop: true,
    spaceBetween: 22,
    breakpoints: {
      1000: {
        slidesPerView: 2,
        spaceBetween: 40,
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".kazanEvents-nav-next-button",
      prevEl: ".kazanEvents-nav-prev-button",
    },
  });

  let swiperContacts = new Swiper(".mySwiperContacts", {
    slidesPerView: "auto",
    loop: true,
    spaceBetween: 20,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-contacts-nav-next-button",
      prevEl: ".swiper-contacts-nav-prev-button",
    },
  });

  let swiperSpaDesk = new Swiper(".mySwiperSpaDesk", {
    slidesPerView: 3,
    loop: true,
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-nav-next-button",
      prevEl: ".swiper-nav-prev-button",
    },
  });

  let swiperRoompageKnow = new Swiper(".mySwiperRoompageKnow", {
    slidesPerView: "auto",
    loop: true,
    spaceBetween: 20,
    breakpoints: {
      1000: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-know-nav-next-button",
      prevEl: ".swiper-know-nav-prev-button",
    },
  });

  let swiperKazanMob = new Swiper(".mySwiperKazanResponsive", {
    slidesPerView: "auto",
    loop: true,
    spaceBetween: 24,
    breakpoints: {
      1000: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-know-nav-next-button",
      prevEl: ".swiper-know-nav-prev-button",
    },
  });

  let swiperPromotionRow1 = new Swiper(".mySwiperPromotionRow1", {
    slidesPerView: "auto",
    loop: true,
    spaceBetween: 20,
    breakpoints: {
      1000: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-promotion-1-nav-next-button",
      prevEl: ".swiper-promotion-1-nav-prev-button",
    },
  });

  let swiperPromotionRow2 = new Swiper(".mySwiperPromotionRow2", {
    slidesPerView: "auto",
    loop: true,
    spaceBetween: 20,
    breakpoints: {
      1000: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-promotion-2-nav-next-button",
      prevEl: ".swiper-promotion-2-nav-prev-button",
    },
  });

  let swiperPromotionRow3 = new Swiper(".mySwiperPromotionRow3", {
    slidesPerView: "auto",
    loop: true,
    spaceBetween: 20,
    breakpoints: {
      1000: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-promotion-3-nav-next-button",
      prevEl: ".swiper-promotion-3-nav-prev-button",
    },
  });

  let swiperKazanMobie = new Swiper(".mySwiperMobileKazan", {
    slidesPerView: 1,
    spaceBetween: 20,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-offer-nav-next-button",
      prevEl: ".swiper-offer-nav-prev-button",
    },
  });

  let swiperKazanOffers = new Swiper(".mySwiperKazanOffers", {
    slidesPerView: "auto",
    spaceBetween: 22,
    loop: true,
    breakpoints: {
      1000: {
        spaceBetween: 40,
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-offer-nav-next-button",
      prevEl: ".swiper-offer-nav-prev-button",
    },
  });

  let swiperRoompageOthers = new Swiper(".mySwiperRoompageOthers", {
    slidesPerView: "auto",
    loop: true,
    spaceBetween: 22,
    watchOverflow: false,
    breakpoints: {
      1000: {
        spaceBetween: 40,
      },
    },
    navigation: {
      prevEl: ".swiper-offer-nav-prev-button",
      nextEl: ".swiper-offer-nav-next-button",
    },
  });

  let swiperGroupRewards = new Swiper(".mySwiperGroupRewards", {
    slidesPerView: "auto",
    loop: false,
    spaceBetween: 40,
    watchOverflow: false,
    enabled: false,
    breakpoints: {
      1000: {
        loop: true,
        enabled: true,
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-offer-nav-next-button",
      prevEl: ".swiper-offer-nav-prev-button",
    },
  });

  let swiperKazanRestaraunts = new Swiper(".mySwiperKazanRestaraunts", {
    slidesPerView: 1,
    loop: true,
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-nav-next-button",
      prevEl: ".swiper-nav-prev-button",
    },
  });

  var swiperRoompage = new Swiper(".mySwiperRoompage", {
    slideDuplicatePrevClass: "slide-roompage-duplicate",
    loop: true,
    speed: 1000,
    centeredSlides: true,
    slidesPerView: "auto",
    breakpoints: {
      1368: {
        spaceBetween: 50,
        slidesPerView: 1.6,
      },
      1000: {
        spaceBetween: 40,
        slidesPerView: 1.6,
      },
      414: {
        spaceBetween: 16,
        slidesPerView: 1,
      },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-roompage-button-next",
      prevEl: ".swiper-roompage-button-prev",
    },
  });

  var swiperIcons = new Swiper(".mySwiperIcons", {
    slidePrevClass: "slide-roompage-icons-prev",
    slideActiveClass: "slide-roompage-icons-active",
    slideNextClass: "slide-roompage-icons-next",
    slidesPerView: "auto",
    breakpoints: {
      1000: {
        centeredSlides: true,
        spaceBetween: 30,
        slidesPerView: 3,
      },
      414: {
        spaceBetween: 40,
      },
    },
    spaceBetween: 72,
    loop: true,
    centeredSlides: false,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-roompage-icons-button-next",
      prevEl: ".swiper-roompage-icons-button-prev",
    },
  });

  var swiper_spa = new Swiper(".mySwiperSpa", {
    slidePrevClass: "slide-spa-prev",
    slideActiveClass: "slide-spa-active",
    loop: true,
    slidesPerView: 3,
    spaceBetween: 41,
    navigation: {
      nextEl: ".swiper-next-spa",
      prevEl: ".swiper-prev-spa",
    },
  });

  let swiperServices = new Swiper(".mySwiperServices", {
    slidesPerView: "auto",
    loop: true,
    spaceBetween: 22,
    breakpoints: {
      1000: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
    },
    navigation: {
      nextEl: ".services-nav-next-button",
      prevEl: ".services-nav-prev-button",
    },
  });

  let swiperVacancies = new Swiper(".swiperVacancies", {
    slidesPerView: "auto",
    loop: true,
    spaceBetween: 35,
    watchOverflow: false,
    navigation: {
      prevEl: ".swiper-offer-nav-prev-button",
      nextEl: ".swiper-offer-nav-next-button",
    },
  });

  let mySwiperTeam1 = new Swiper(".mySwiperTeam1", {
    loop: true,
    spaceBetween: 36,
    slidesPerViev: 3,
    breakpoints: {
      420: {
        slidesPerView: 1,
      },
      1000: {
        slidesPerView: 3,
      },
    },
    navigation: {
      prevEl: ".swiper-offer-nav-prev-button",
      nextEl: ".swiper-offer-nav-next-button",
    },
  });

  let swiperProjects = new Swiper(".projects-swiper", {
    slidesPerView: 2,
    loop: true,
    spaceBetween: 32,
    breakpoints: {
      414: {
        slidesPerView: 1.2,
        spaceBetween: 0,
      },
    },
  });

  let swiperContactCards = new Swiper(".contacts-swiper", {
    slidesPerView: 1,
    loop: true,
    spaceBetween: 32,
    breakpoints: {
      572: {
        slidesPerView: 2,
      },
    },
  });

  if (document.querySelector(".mySwiperOffers")) {
    swiperOffers.on("slideChangeTransitionStart", () => {
      get("id", "offers-title").style.zIndex = "99";
    });

    swiperOffers.on("slideChangeTransitionEnd", () => {
      get("id", "offers-title").style.zIndex = "2";
    });
  }

  const query = (query) => document.querySelector(query);

  swiper_spa.on("slideChange", (index) => {
    console.log(index.realIndex);
    elem("spa-counter-current").innerHTML = `0${index.realIndex + 1}`;
    const currentSlideData = {
      src: query(".slide-spa-active img").src,
      title: query(".slide-spa-active p").innerHTML,
      label: query(".slide-spa-active span").innerHTML,
    };
    elem("spa_current_img").style.opacity = "0";

    setTimeout(() => {
      elem("spa_current_img").src = currentSlideData.src;
      elem("spa_current_img").style.opacity = "1";
      elem("spa_current_p").innerHTML = currentSlideData.title;
      elem("spa_current_span").innerHTML = currentSlideData.label;
    }, 100);
  });
}

let cond = {};
let d = document;
var newEl = d.createElement("span");
newEl.classList.add("myObserver");

if (document.querySelector(".kravt_gallery_grids")) {
  document.querySelector("#loadMore").addEventListener("click", () => {
    let select_data;

    let galleryId = Array.from(
      document.querySelectorAll(".kravt_gallery_menu-item")
    ).indexOf(document.querySelector(".kravt_gallery_menu-active"));
    let galleryLength = document
      .querySelectorAll(".kravt_gallery_grid")
      [galleryId].querySelectorAll("img").length;

    select_data = {
      galleryId: galleryId,
      galleryLength: galleryLength,
    };

    $.ajax({
      type: "GET", //Метод отправки
      url: window.location.href, //путь до php фаила отправителя
      dataType: "html",
      data: select_data,
      success: function (data) {
        // сoбытиe пoслe удaчнoгo oбрaщeния к сeрвeру и пoлучeния oтвeтa
        document
          .querySelectorAll(".kravt_gallery_grid")
          [select_data.galleryId].insertAdjacentHTML("beforeend", data);
        if (data != "") {
          galleryPopup();
        } else {
          document.querySelector("#loadMore").style.display = "none";
        }
      },

      error: function (jqXHR, exception) {
        console.log(jqXHR, exception);
      },
    });
  });
}

if (document.querySelector(".kravt_kazan_rooms_extend-list.dropdown")) {
  var ref = d.querySelectorAll(".container.container-spacing")[0];

  insertBefore(newEl, ref);

  function insertBefore(el, referenceNode) {
    referenceNode.parentNode.insertBefore(el, referenceNode);
  }

  cond.head = ".kravt_kazan_rooms_hero_title div";

  var observer = new IntersectionObserver(
    function (entries) {
      if (entries[0].intersectionRatio === 0) {
        d.querySelector(cond.head).classList.add("sticky-element");
      } else if (entries[0].intersectionRatio === 1) {
        d.querySelector(cond.head).classList.remove("sticky-element");
      }
    },
    { threshold: [0, 1] }
  );

  observer.observe(d.querySelector(".myObserver"));

  cond.dropDown = ".kravt_kazan_rooms_extend-list";
  Array.from(document.querySelectorAll(cond.dropDown)).forEach((element) => {
    element.addEventListener("click", (event) => {
      event.preventDefault();
      let target = element.parentElement.querySelector("ul");
      target.classList.toggle("active");
      if (target.classList.contains("active")) {
        element.text = "Скрыть список";
      } else {
        element.text = "Показать полный список";
      }
      target.clientHeight = "100%";
    });
  });
}

if (document.querySelector(".header_main")) {
  Array.from(document.querySelectorAll("#phone_button"), (element) => {
    element.addEventListener("click", (el) => {
      el.preventDefault();
      document
        .getElementById("tl-search-form")
        .querySelector("iframe")
        .contentWindow.document.querySelector("input[value='Найти номер']")
        .click();
    });
  });
}

if (
  document.querySelector(".button-roompage") &&
  document.querySelector(".button-roompage").parentElement.classList[0] !=
    "press_toggler"
) {
  document.querySelector(".button-roompage:not(.booking-offer-link)").addEventListener("click", (el) => {
    if (!el.target.classList.contains("custom")) {
      document
        .getElementById("tl-search-form")
        .querySelector("iframe")
        .contentWindow.document.querySelector("input[value='Найти номер']")
        .click();
    }
  });
}

// if (window.innerWidth > 1000) {
//   Array.from(
//     document.querySelectorAll(".kravt_dropdown.promotion .kravt_dropdown_link"),
//     (element) => {
//       element.addEventListener("click", (event) => {
//         if (event.target.closest(".kravt_dropdown_content.ch")) {
//           event.target.closest(".kravt_dropdown_content.ch").style.display =
//             "none";
//           setTimeout(() => {
//             event.target
//               .closest(".kravt_dropdown_content.ch")
//               .removeAttribute("style");
//           }, 500);
//         }
//       });
//     }
//   );
// }

if (document.querySelector(".kravt_dropdown.promotion")) {
  // get data from page on promotion teplate
  var select_data = {};

  document
    .querySelectorAll(".kravt_dropdown.promotion a.city")[0]
    .classList.add("current");
  select_data.siteCity = document.querySelectorAll(
    ".kravt_dropdown.promotion a.city"
  )[0].dataset.city;

  document
    .querySelectorAll(".kravt_dropdown.promotion a.hotels")[0]
    .classList.add("current");
  select_data.siteHotel = document.querySelectorAll(
    ".kravt_dropdown.promotion a.hotels"
  )[0].dataset.hotel;

  Array.from(
    document.querySelectorAll(".kravt_dropdown.promotion a.hotels")
  ).forEach((el) => {
    if (
      el.dataset.city !=
      document.querySelector(".kravt_dropdown.promotion a.city.current").dataset
        .city
    ) {
      el.style.display = "none";
    }
  });

  if (document.querySelector(".kravt_dropdown.promotion.events")) {
    document
      .querySelectorAll(".kravt_dropdown.promotion a.events")[0]
      .classList.add("current");
    select_data.siteEvent = document.querySelectorAll(
      ".kravt_dropdown.promotion a.events"
    )[0].dataset.event;
    Array.from(
      document.querySelectorAll(".kravt_dropdown.promotion a.events")
    ).forEach((el) => {
      if (
        el.dataset.city !=
          document.querySelector(".kravt_dropdown.promotion a.city.current")
            .dataset.city ||
        el.dataset.hotel !=
          document.querySelector(".kravt_dropdown.promotion a.hotels.current")
            .dataset.hotel
      ) {
        el.style.display = "none";
      }
    });
  }

  function reloadPromotion() {
    if (document.querySelector(".kravt_dropdown.promotion.events")) {
      console.log('#1');
      // Cities
      Array.from(
        document.querySelectorAll(".kravt_dropdown.promotion a.city")
      ).forEach((element) => {
        element.addEventListener("click", (e) => {
          e.preventDefault();
          // get current city
          Array.from(
            document.querySelectorAll(".kravt_dropdown.promotion a.city")
          ).forEach((el) => {
            el.classList.remove("current");
          });
          element.classList.add("current");
          element.parentElement.parentElement.querySelector("span").innerHTML =
            element.querySelector("p").innerHTML;

          (select_data.siteCity = e.target.closest("a").dataset.city),
            Array.from(
              document.querySelectorAll(".kravt_dropdown.promotion a.hotels")
            ).forEach((elem) => {
              elem.style.display = "flex";
              if (elem.dataset.city != element.dataset.city) {
                elem.style.display = "none";
              }
            });
        });
      });

      // Hotels
      Array.from(
        document.querySelectorAll(".kravt_dropdown.promotion a.hotels")
      ).forEach((element) => {
        element.addEventListener("click", (e) => {
          e.preventDefault();
          // get current Hotel
          Array.from(
            document.querySelectorAll(".kravt_dropdown.promotion a.hotels")
          ).forEach((el) => {
            el.classList.remove("current");
          });
          element.classList.add("current");
          element.parentElement.parentElement.querySelector("span").innerHTML =
            element.querySelector("p").innerHTML;

          (select_data.siteHotel = e.target.closest("a").dataset.hotel),
            Array.from(
              document.querySelectorAll(".kravt_dropdown.promotion a.events")
            ).forEach((elem) => {
              elem.style.display = "flex";
              if (elem.dataset.hotel != element.dataset.hotel) {
                elem.style.display = "none";
              }
            });
        });
      });

      // Events
      Array.from(
        document.querySelectorAll(".kravt_dropdown.promotion a.events")
      ).forEach((element) => {
        element.addEventListener("click", (e) => {
          e.preventDefault();

          Array.from(
            document.querySelectorAll(".kravt_dropdown.promotion a.events")
          ).forEach((el) => {
            el.classList.remove("current");
          });

          element.parentElement.parentElement.querySelector("span").innerHTML =
            element.querySelector("p").innerHTML;

          element.classList.add("current");
          select_data.siteEvent = element.querySelector("p").innerHTML;

          var stringToHTML = (str) => {
            var parser = new DOMParser();
            var doc = parser.parseFromString(str, "text/html");
            return doc.body;
          };

          var newHtml = "";
          $.ajax({
            type: "GET", //Метод отправки
            url: window.location.href, //путь до php фаила отправителя
            dataType: "html",
            data: select_data,
            success: function (data) {
              // сoбытиe пoслe удaчнoгo oбрaщeния к сeрвeру и пoлучeния oтвeтa
              Array.from(document.querySelectorAll("section")).forEach(
                (element) => {
                  element.remove();
                }
              );

              // console.log(data);
              document.querySelector("main").innerHTML =
                document.querySelector("main").innerHTML + data;

              reloadPromotion();

              let swiperScreen = new Swiper(".mySwiperScreen", {
                slidesPerView: "auto",
                loop: true,
                pagination: {
                  el: ".swiper-pagination",
                  clickable: true,
                },
                navigation: {
                  nextEl: ".kravt_screen-swiper-arrow",
                  prevEl: ".swiper-nav-prev-button",
                },
              });
            },
            error: function (jqXHR, exception) {
              console.log(jqXHR, exception);
            },
          });
        });
      });
    } else {
      function render(element) {
        Array.from(
          document.querySelectorAll(".kravt_dropdown.promotion a.hotels")
        ).forEach((el) => {
          el.classList.remove("current");
        });

        element.classList.add("current");

        var stringToHTML = (str) => {
          var parser = new DOMParser();
          var doc = parser.parseFromString(str, "text/html");
          return doc.body;
        };

        var newHtml = "";
        $.ajax({
          type: "GET", //Метод отправки
          url: window.location.href, //путь до php фаила отправителя
          dataType: "html",
          data: select_data,
          success: function (data) {
            // сoбытиe пoслe удaчнoгo oбрaщeния к сeрвeру и пoлучeния oтвeтa

            Array.from(document.querySelectorAll("section")).forEach(
              (element) => {
                element.remove();
              }
            );

            // console.log(data);
            document.querySelector("main").innerHTML =
              document.querySelector("main").innerHTML + data;

            reloadPromotion();

            swiperPromotionRow1 = new Swiper(".mySwiperPromotionRow1", {
              slidesPerView: "auto",
              loop: true,
              spaceBetween: 20,
              breakpoints: {
                1000: {
                  slidesPerView: 3,
                  spaceBetween: 40,
                },
              },
              pagination: {
                el: ".swiper-pagination",
                clickable: true,
              },
              navigation: {
                nextEl: ".swiper-promotion-1-nav-next-button",
                prevEl: ".swiper-promotion-1-nav-prev-button",
              },
            });

            swiperPromotionRow2 = new Swiper(".mySwiperPromotionRow2", {
              slidesPerView: "auto",
              loop: true,
              spaceBetween: 20,
              breakpoints: {
                1000: {
                  slidesPerView: 3,
                  spaceBetween: 40,
                },
              },
              pagination: {
                el: ".swiper-pagination",
                clickable: true,
              },
              navigation: {
                nextEl: ".swiper-promotion-2-nav-next-button",
                prevEl: ".swiper-promotion-2-nav-prev-button",
              },
            });

            swiperPromotionRow3 = new Swiper(".mySwiperPromotionRow3", {
              slidesPerView: "auto",
              loop: true,
              spaceBetween: 20,
              breakpoints: {
                1000: {
                  slidesPerView: 3,
                  spaceBetween: 40,
                },
              },
              pagination: {
                el: ".swiper-pagination",
                clickable: true,
              },
              navigation: {
                nextEl: ".swiper-promotion-3-nav-next-button",
                prevEl: ".swiper-promotion-3-nav-prev-button",
              },
            });
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR, exception);
          },
        });        
      }

      // Hotels
      Array.from(
        document.querySelectorAll(".kravt_dropdown.promotion a.hotels")
      ).forEach((element) => {
        element.addEventListener("click", (e) => {
          e.preventDefault();

          Array.from(
            document.querySelectorAll(".kravt_dropdown.promotion a.hotels")
          ).forEach((el) => {
            el.classList.remove("current");
          });

          element.parentElement.parentElement.querySelector("span").innerHTML =
          element.querySelector("p").innerHTML;

          select_data.siteHotel = element.querySelector("p").innerHTML;

          render(element);
        });
      });

      // Cities
      Array.from(
        document.querySelectorAll(".kravt_dropdown.promotion a.city")
      ).forEach((element) => {
        element.addEventListener("click", (e) => {
          e.preventDefault();
          // get current city
          Array.from(
            document.querySelectorAll(".kravt_dropdown.promotion a.city")
          ).forEach((el) => {
            el.classList.remove("current");
          });
          element.classList.add("current");
          element.parentElement.parentElement.querySelector("span").innerHTML =
            element.querySelector("p").innerHTML;

          let minIndex = -1;
          let defaultHotel;
          let hotelSelect;

          (select_data.siteCity = e.target.closest("a").dataset.city),
            Array.from(
              document.querySelectorAll(".kravt_dropdown.promotion a.hotels")
            ).forEach((elem, index) => {
              elem.style.display = "flex";
              if (!hotelSelect) {
                hotelSelect = elem.closest('.kravt_dropdown.promotion');
              }

              if (elem.dataset.city != element.dataset.city) {
                elem.style.display = "none";
              } else {
                if (minIndex === -1 || index < minIndex) {
                  minIndex = index;
                  defaultHotel = elem;
                }
              }
            });

            if (minIndex !== -1) {
              if (defaultHotel) {
                if (hotelSelect) {
                  hotelSelect.querySelector('.kravt_dropdown_label-hotels span').innerHTML = defaultHotel.querySelector('p').innerHTML;
                  select_data.siteHotel = defaultHotel.querySelector('p').innerHTML;
      
                  render(defaultHotel);
                }
              }
            }
        });
      });
    }

    // reloadPromotion();
  }
  reloadPromotion();
}

if (document.querySelector(".profile_close")) {
  document.querySelector(".profile_close").addEventListener("click", () => {
    document
      .querySelector(".profile_popup_background")
      .classList.remove("active");
    document.querySelector("#profile_popup").classList.remove("visible");
    document.querySelector("body").style.overflowY = "auto";
  });
  document.querySelector(".profile_close svg").addEventListener("click", () => {
    document
      .querySelector(".profile_popup_background")
      .classList.remove("active");
    document.querySelector("#profile_popup").classList.remove("visible");
    document.querySelector("body").style.overflowY = "auto";
  });
}

if (document.querySelector(".our_team")) {
  if (window.innerWidth < 1001) {
    document
      .querySelector(".profile_wrapper")
      .classList.add("swiper", "mySwiperTeam");

    Array.from(document.querySelectorAll(".profile"), (element) =>
      element.classList.add("swiper-slide")
    );

    document.querySelector(
      ".profile_wrapper"
    ).innerHTML = `<div class="swiper-wrapper">${
      document.querySelector(".profile_wrapper").innerHTML
    }</div>`;

    let swiperGroupRewards = new Swiper(".mySwiperTeam", {
      slidesPerView: 1.4,
      loop: true,
      breakpoints: {
        801: {
          centeredSlides: true,
        },
        415: {
          slidesPerView: "auto",
        },
      },
      spaceBetween: 16,
    });
  }
}

const popupElement = [".additional_link", ".mySwiperTeam1 .profile"];

if (document.querySelector("#profile_popup")) {
  Array.from(document.querySelectorAll(".additional_link"), (element) => {
    element.addEventListener("click", (elem) => {
      document
        .querySelector(".profile_popup_background")
        .classList.toggle("active");
      document.querySelector("#profile_popup").classList.toggle("visible");
      document.querySelector("body").style.overflowY = "hidden";
      var select_data = {
        profileID: elem.target.dataset.profileid,
      };
      if (
        document.querySelector(".profile_main").dataset.profileid !==
        select_data.profileID
      ) {
        $.ajax({
          type: "GET", //Метод отправки
          url: window.location.href, //путь до php фаила отправителя
          dataType: "html",
          data: select_data,
          success: function (data) {
            // сoбытиe пoслe удaчнoгo oбрaщeния к сeрвeру и пoлучeния oтвeтa

            document.querySelector(".profile_main").remove();

            document
              .querySelector(".profile_slider")
              .insertAdjacentHTML("beforebegin", data);
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR, exception);
          },
        });
      }
    });
  });

  Array.from(
    document.querySelectorAll(".mySwiperTeam1 .profile"),
    (element) => {
      element.addEventListener("click", (elem) => {
        var select_data = {
          profileID: elem.target.closest(".profile").dataset.profileid,
        };
        $.ajax({
          type: "GET", //Метод отправки
          url: window.location.href, //путь до php фаила отправителя
          dataType: "html",
          data: select_data,
          success: function (data) {
            // сoбытиe пoслe удaчнoгo oбрaщeния к сeрвeру и пoлучeния oтвeтa

            document.querySelector(".profile_main").remove();
            $(data).insertBefore(".profile_slider").show("slow");
            // document.querySelector('.profile_slider').insertAdjacentHTML('beforebegin', data);
          },
          error: function (jqXHR, exception) {
            console.log(jqXHR, exception);
          },
        });
      });
    }
  );

  document.querySelector("#profile_popup").addEventListener("click", (el) => {
    if (
      !el.target.classList.contains("profile_popup_wrapper") &&
      el.target.id == "profile_popup"
    ) {
      document
        .querySelector(".profile_popup_background")
        .classList.toggle("active");
      document.querySelector("#profile_popup").classList.toggle("visible");
      document.querySelector("body").style.overflowY = "auto";
    }
  });
}

if (document.querySelector(".press_links")) {
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);

  if (urlParams.get("tab")) {
    document
      .querySelector(".press_links")
      .querySelectorAll("a")
      [urlParams.get("tab")].classList.remove("kravt_events_link");
    document
      .querySelector(".press_links")
      .querySelectorAll("a")
      [urlParams.get("tab")].classList.add("kravt_events_link-active");
    Array.from(document.querySelector(".press_content").children).forEach(
      (el, index) => {
        if (index == urlParams.get("tab")) {
          el.classList.toggle("active");
        }
      }
    );
  } else {
    document
      .querySelector(".press_links")
      .querySelectorAll("a")[0]
      .classList.remove("kravt_events_link");
    document
      .querySelector(".press_links")
      .querySelectorAll("a")[0]
      .classList.add("kravt_events_link-active");
    Array.from(document.querySelector(".press_content").children).forEach(
      (el, index) => {
        if (index == 0) {
          el.classList.toggle("active");
        }
      }
    );
  }

  Array.from(document.querySelectorAll(".event-link-handle"), (element) => {
    element.addEventListener("click", (e) => {
      Array.from(document.querySelectorAll(".event-link-handle"), (e) => {
        e.classList.remove("kravt_events_link-active");
        e.classList.add("kravt_events_link");
      });
      document
        .querySelectorAll(".event-link-handle")
        [
          Array.from(document.querySelectorAll(".event-link-handle")).indexOf(
            element
          )
        ].classList.remove("kravt_events_link");
      document
        .querySelectorAll(".event-link-handle")
        [
          Array.from(document.querySelectorAll(".event-link-handle")).indexOf(
            element
          )
        ].classList.add("kravt_events_link-active");
      Array.from(document.querySelectorAll(".press_item-wrapper"), (el) => {
        el.classList.remove("active");
      });

      document
        .querySelectorAll(".press_item-wrapper")
        [
          Array.from(document.querySelectorAll(".event-link-handle")).indexOf(
            element
          )
        ].classList.toggle("active");
    });
  });
}

if (document.querySelector(".press_toggler")) {
  var ref = d.querySelectorAll(".container.container-spacing")[0];

  insertBefore(newEl, ref);

  function insertBefore(el, referenceNode) {
    referenceNode.parentNode.insertBefore(el, referenceNode);
  }

  cond.head = ".press_toggler";

  var observer = new IntersectionObserver(
    function (entries) {
      if (entries[0].intersectionRatio === 0) {
        d.querySelector(cond.head).classList.add("sticky-element");
      } else if (entries[0].intersectionRatio === 1) {
        d.querySelector(cond.head).classList.remove("sticky-element");
      }
    },
    { threshold: [0, 1] }
  );

  observer.observe(d.querySelector(".myObserver"));
}

if (document.querySelector(".press_legal")) {
  if (window.innerWidth > 1000) {
    Array.from(document.querySelectorAll(".document_title"), (toggler) => {
      toggler.addEventListener("click", (event) => {
        event.target.closest(".document_title").classList.toggle("open");

        let container = event.target
          .closest(".documents_wrapper")
          .querySelector(".document_files");

        if (!container.classList.contains("active")) {
          container.classList.add("active");
          container.style.height = "auto";

          var height = container.clientHeight + 25 + "px";

          container.style.height = "0px";

          setTimeout(function () {
            container.style.height = height;
          }, 0);
        } else {
          container.style.height = "0px";

          container.addEventListener(
            "transitionend",
            function () {
              container.classList.remove("active");
            },
            {
              once: true,
            }
          );
        }
      });
    });
  }
}

if (document.querySelector(".kravt_burger_down-link")) {
  Array.from(
    document.querySelectorAll(".kravt_burger_down-link"),
    (element) => {}
  );
}
