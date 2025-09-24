<template>
    <div>
        <section id="gallery" class="uk-section uk-section-default bg-f2" style="padding-bottom: 40px;">
            <div class="uk-container uk-container-small">
                <h2 class="tw-text-3xl sm:tw-text-4xl tw-mb-8 uk-text-center midnight yn-color"
                    uk-scrollspy="cls: uk-animation-slide-top; delay: 300"
                    style="">
                    Gallery
                </h2>
                <div class="uk-child-width-1-2 uk-child-width-1-4@m uk-grid" uk-grid="" uk-lightbox="animation: slide">
                    <div class="uk-first-column"
                        uk-scrollspy="cls: uk-animation-slide-left; delay: 500">
                        <a class="uk-inline"
                            href="assets/images/gallery/1.jpg">
                            <img class="thumb-gallery" src="assets/images/gallery/1.jpg" alt="Our Prawedding Photo">
                        </a>
                    </div>
                    <div uk-scrollspy="cls: uk-animation-slide-right; delay: 500">
                        <a class="uk-inline"
                            href="assets/images/gallery/2.jpg">
                            <img class="thumb-gallery" src="assets/images/gallery/2.jpg" alt="Our Prawedding Photo">
                        </a>
                    </div>
                    <div class="uk-grid-margin uk-first-column"
                        uk-scrollspy="cls: uk-animation-slide-left; delay: 700">
                        <a class="uk-inline"
                            href="assets/images/gallery/3.jpg" style="">
                            <img class="thumb-gallery" src="assets/images/gallery/3.jpg" alt="Our Prawedding Photo">
                        </a>
                    </div>
                    <div class="uk-grid-margin"
                        uk-scrollspy="cls: uk-animation-slide-right; delay: 700">
                        <a class="uk-inline"
                            href="assets/images/gallery/4.jpg" style="">
                            <img class="thumb-gallery" src="assets/images/gallery/4.jpg" alt="Our Prawedding Photo">
                        </a>
                    </div>
                    <div class="uk-grid-margin uk-first-column"
                        uk-scrollspy="cls: uk-animation-slide-left; delay: 900">
                        <a class="uk-inline"
                            href="assets/images/gallery/5.jpg" style="">
                            <img class="thumb-gallery" src="assets/images/gallery/5.jpg" alt="Our Prawedding Photo">
                        </a>
                    </div>
                    <div class="uk-grid-margin"
                        uk-scrollspy="cls: uk-animation-slide-right; delay: 900">
                        <a class="uk-inline"
                            href="assets/images/gallery/6.jpg" style="">
                            <img class="thumb-gallery" src="assets/images/gallery/6.jpg" alt="Our Prawedding Photo">
                        </a>
                    </div>
                    <div class="uk-grid-margin uk-first-column"
                        uk-scrollspy="cls: uk-animation-slide-left; delay: 1100">
                        <a class="uk-inline"
                            href="assets/images/gallery/7.jpg" style="">
                            <img class="thumb-gallery" src="assets/images/gallery/7.jpg" alt="Our Prawedding Photo">
                        </a>
                    </div>
                    <div class="uk-grid-margin"
                        uk-scrollspy="cls: uk-animation-slide-right; delay: 1100">
                        <a class="uk-inline"
                            href="assets/images/gallery/8.jpg" style="">
                            <img class="thumb-gallery" src="assets/images/gallery/8.jpg" alt="Our Prawedding Photo">
                        </a>
                    </div>
                </div>

            </div>
        </section>
    </div>
</template>

<script>
    export default {

    }
</script>

<style scoped>
/* We're using UIkit's built-in animations, so we don't need custom CSS */
</style>
