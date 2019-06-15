<template>
    <div>
        <div class="readers_comment">
            <div class="single_media_title">
                <h2>Related Comments</h2>
            </div>
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img alt="64x64" class="media-object" data-src="assets/img/img-author1.jpg" src="assets/img/img-author1.jpg" data-holder-rendered="true">
                    </a>
                </div>
                <div class="media-body">
                    <h2 class="media-heading">Sr. Ryan</h2>
                    But who has any right to find fault with a man who chooses to enjoy a pleasure that has
                    no annoying consequences, or one who avoids a pain that produces no resultant pleasure?
                    <div class="comment_article_social">
                        <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
                        <a href="#"><span class="reply_ic">Reply </span></a>
                    </div>
                    <div class="media reply">
                        <div class="media-left">
                            <a href="#">
                                <img alt="64x64" class="media-object" data-src="assets/img/img-author2.jpg" src="assets/img/img-author2.jpg" data-holder-rendered="true">
                            </a>
                        </div>
                        <div class="media-body">
                            <h2 class="media-heading">Admin</h2>
                            But who has any right to find fault with a man who chooses to enjoy a pleasure
                            that has no annoying consequences, or one who avoids a pain that produces no
                            resultant pleasure?
                            <div class="comment_article_social">
                                <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
                                <a href="#"><span class="reply_ic"> Reply </span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img alt="64x64" class="media-object" data-src="assets/img/img-author1.jpg" src="assets/img/img-author1.jpg" data-holder-rendered="true">
                    </a>
                </div>
                <div class="media-body">
                    <h2 class="media-heading">S. Joshep</h2>
                    But who has any right to find fault with a man who chooses to enjoy a pleasure that has
                    no annoying consequences, or one who avoids a pain that produces no resultant pleasure?
                    <div class="comment_article_social">
                        <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></a>
                        <a href="#"><span class="reply_ic"> Reply </span></a>
                    </div>
                </div>
            </div>
        </div>
        <!--readers_comment-->
        <div class="add_a_comment">
            <div class="single_media_title">
                <h2>Add a Comment</h2>
            </div>
            <div class="comment_form">
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                    <div class="form-group comment">
                        <textarea class="form-control" id="inputComment" placeholder="Comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-submit red">Submit</button>
                </form>
            </div>
            <!--comment_form-->
        </div>
    </div>
</template>
<script>
export default {
    name: 'Comment',
    props: ['data'],
    created: function() {

    },
};

</script>
