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
    const path = window.location.pathname;
    //const movieID = document.getElementById("movieID").value;
    const csrfToken = document
        .getElementsByTagName("meta")[3]
        .getAttribute("content");
    // const url = `http://localhost/asw-movies/public/movie/${movieID}/${this.name}`;
    const url = `${path}/${this.name}`; // name of the button
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
                    this.innerHTML = " FAVORITE ?";
                    break;
                case "viewed":
                    this.innerHTML = " WATCHED?";
                    document.getElementById("seeLater").style.display =
                        "inline-block";
                    break;
                case "watch_later":
                    this.innerHTML = " SEE LATER ?";
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
                case "watch_later":
                    this.innerHTML = " SEE LATER";
                    break;
            }
        }
    } catch (error) {
        console.error(error);
    }
}

userIsLogged();
