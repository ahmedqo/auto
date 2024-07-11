if (document.querySelector("#ui-review-carousel"))
    Slider({
        root: document.querySelector("#ui-review-carousel"),
        prev: document.querySelector("#ui-review-prev"),
        next: document.querySelector("#ui-review-next"),
        opts: {
            drag: true,
            gaps: 24
        }
    }).lg({
        cols: 3,
        move: 3
    }).xl({
        cols: 3,
        move: 3
    });