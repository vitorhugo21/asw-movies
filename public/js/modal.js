$(document).ready(function() {
    let $videoSrc;
    $(".video-btn").click(function() {
        $videoSrc = $(this).attr("data-src");

        $("#myModal").on("shown.bs.modal", function(e) {
            $("#video").attr(
                "src",
                $videoSrc + "?modestbranding=1&amp;showinfo=0"
            );
        });

        // stop playing the youtube video when I close the modal
        $("#myModal").on("hide.bs.modal", function(e) {
            // a poor man's stop video
            $("#video").attr("src", $videoSrc);
        });
    });
});
