if (document.querySelector("#ui-car-carousel"))
    Slider({
        root: document.querySelector("#ui-car-carousel"),
        prev: document.querySelector("#ui-car-prev"),
        next: document.querySelector("#ui-car-next"),
        opts: {
            drag: true,
            gaps: 24
        }
    }).lg({
        cols: 2,
        move: 2
    }).xl({
        cols: 3,
        move: 3
    });

if (document.querySelector("#ui-blog-carousel"))
    Slider({
        root: document.querySelector("#ui-blog-carousel"),
        prev: document.querySelector("#ui-blog-prev"),
        next: document.querySelector("#ui-blog-next"),
        opts: {
            drag: true,
            gaps: 24
        }
    }).sm({
        cols: 2,
        move: 2,
    }).md({
        cols: 2,
        move: 2,
    }).lg({
        cols: 3,
        move: 3,
    }).xl({
        cols: 4,
        move: 4
    });