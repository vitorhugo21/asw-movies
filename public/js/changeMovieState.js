function userIsLogged() {
    if (!!document.getElementById("movieID")) {
        let btnWatch = document.getElementById("watch");
        btnWatch.name = "viewed";

        let btnSeeLater = document.getElementById("seeLater");
        btnSeeLater.name = "watch_later";

        let btnFavorite = document.getElementById("favorite");
        btnFavorite.name = "favorite";

        btnFavorite.onclick = changeBtnState;
        btnSeeLater.onclick = changeBtnState;
        btnWatch.onclick = changeBtnState;
    }
}

async function changeBtnState() {
    const movieID = document.getElementById("movieID").value;
    const csrfToken = document
        .getElementsByTagName("meta")[3]
        .getAttribute("content");
    const url = `http://127.0.0.1:8000/movie/${movieID}/${this.name}`;
    const settings = {
        method: "POST",
        headers: {
            Accept: "application/json",
            "X-CSRF-TOKEN": csrfToken
        }
    };
    try {
        let response = await fetch(url, settings);
        let data = await response.json();
        if (data === 0) {
            this.classList.remove("active");
            switch (this.name) {
                case "favorite":
                    this.innerHTML = " MARK AS FAVORITE";
                    break;
                case "viewed":
                    this.innerHTML = " WATCHED?";
                    document.getElementById("seeLater").style.display =
                        "inline-block";
                    break;
            }
        } else {
            this.classList.add("active");
            switch (this.name) {
                case "favorite":
                    this.innerHTML = " FAVORITE";
                    break;
                case "viewed":
                    this.innerHTML = " WATCHED";
                    document.getElementById("seeLater").style.display = "none";
                    break;
            }
        }
    } catch (error) {
        console.error(error);
    }
}

userIsLogged();
