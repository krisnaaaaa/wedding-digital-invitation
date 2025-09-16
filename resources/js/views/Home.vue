<template>
    <div>
        <Audio></Audio>

        <Cover></Cover>

        <Mempelai></Mempelai>

        <Acara></Acara>

        <Gallery></Gallery>

        <Protocol></Protocol>

        <section id="bukutamu" class="uk-container uk-container-small">
            <div class="tw-h-24"></div>

            <section>
                <h2
                    class="tw-text-3xl sm:tw-text-4xl tw-text-center"
                    style="font-family: Scarlet"
                >
                    Buku Tamu
                </h2>

                <button
                    class="uk-button uk-button-success uk-align-center"
                    type="button"
                    uk-toggle="target: #buku; animation:  uk-animation-slide-left;"
                    style="margin-bottom: 0px"
                    aria-expanded="false"
                >
                    <span uk-icon="icon: file-edit;" class="uk-icon"
                        ><svg
                            width="20"
                            height="20"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill="none"
                                stroke="#000"
                                d="M18.65,1.68 C18.41,1.45 18.109,1.33 17.81,1.33 C17.499,1.33 17.209,1.45 16.98,1.68 L8.92,9.76 L8,12.33 L10.55,11.41 L18.651,3.34 C19.12,2.87 19.12,2.15 18.65,1.68 L18.65,1.68 L18.65,1.68 Z"
                            ></path>
                            <polyline
                                fill="none"
                                stroke="#000"
                                points="16.5 8.482 16.5 18.5 3.5 18.5 3.5 1.5 14.211 1.5"
                            ></polyline></svg
                    ></span>
                    Isi Buku Tamu
                </button>

                <a
                    class="uk-button uk-button-success uk-align-center"
                    href="#modal-center"
                    uk-toggle=""
                    style="width: 171px; margin-top: 8px"
                    aria-expanded="false"
                    >Gifts</a
                >

                <!-- gifts -->
                <div id="modal-center" class="uk-flex-top uk-modal" uk-modal="">
                    <div
                        class="
                            uk-modal-dialog
                            uk-modal-body
                            uk-margin-auto-vertical
                        "
                        style="color: #333"
                    >
                        <button
                            class="uk-modal-close-default uk-icon uk-close"
                            type="button"
                            uk-close=""
                        ></button>
                        <p class="uk-text-center tw-mb-5">
                            Scan untuk memberikan kebahagian kepada Pengantin.
                        </p>
                        <ul uk-accordion="" class="uk-accordion">
                            <li class="uk-open">
                                <a class="uk-accordion-title" href="#">OVO</a>
                                <div class="uk-accordion-content">
                                    <img
                                        src="assets/images/gifts/ovo.jpg"
                                        class="tw-mx-auto tw-h-auto"
                                        width="400"
                                        alt="OVO QR CODE"
                                    />
                                </div>
                            </li>
                            <li class="uk-open">
                                <a class="uk-accordion-title" href="#">BCA</a>
                                <div class="uk-accordion-content">
                                    <img
                                        src="assets/images/gifts/bca.jpg"
                                        class="tw-mx-auto tw-h-auto"
                                        width="400"
                                        alt="BCA QR CODE"
                                    />
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <FormGuestBook v-on:completed="addComment"></FormGuestBook>
            </section>

            <div class="tw-h-16"></div>

            <div id="guest_comment" class="uk-container uk-container-small">
                <!-- Loading indicator for initial load -->
                <div v-if="loading && comments.length === 0" class="uk-text-center uk-margin">
                    <div uk-spinner></div>
                    <p class="uk-text-muted">Memuat komentar...</p>
                </div>

                <!-- Comments list -->
                <Comment
                    data-aos="slide-up"
                    data-aos-offset="100"
                    data-aos-easing="ease-out-back"
                    v-for="(comment, index) in comments"
                    v-bind:comment="comment"
                    v-bind:key="comment.id || index"
                ></Comment>

                <!-- Infinite loading component -->
                <infinite-loading
                    spinner="spiral"
                    @distance="1"
                    @disabled="busy || !hasMore"
                    @infinite="loadMore"
                >
                    <div slot="no-more">
                        <div class="uk-text-center uk-margin">
                            <p class="uk-text-muted">Semua komentar telah dimuat</p>
                        </div>
                    </div>
                    <div slot="no-results">
                        <div class="uk-text-center uk-margin">
                            <p class="uk-text-muted">Belum ada komentar</p>
                        </div>
                    </div>
                </infinite-loading>

                <!-- Loading more indicator -->
                <div v-if="loading && comments.length > 0" class="uk-text-center uk-margin">
                    <div uk-spinner></div>
                    <p class="uk-text-muted">Memuat komentar lainnya...</p>
                </div>
            </div>
        </section>

        <div class="tw-h-28"></div>

        <p
            class="
                tw-text-xs tw-text-extralight tw-text-center tw-italic
                text-thelast
            "
        >
            - 'the last good man'
        </p>

        <hr class="divider-thelast" />

        <div class="tw-h-12"></div>

        <Navbar></Navbar>
        <MusicBox></MusicBox>
    </div>
</template>

<script>
import Comment from "./components/Comment.vue";
import Gallery from "./components/Gallery.vue";
import Acara from "./components/Acara.vue";
import Mempelai from "./components/Mempelai.vue";
import Cover from "./components/Cover.vue";
import FormGuestBook from "./components/FormGuestBook.vue";

import Audio from "./addon/Audio.vue";
import Navbar from "./addon/Navbar.vue";
import MusicBox from "./addon/MusicBox.vue";
import Protocol from "./addon/Protocol.vue";

import InfiniteLoading from "vue-infinite-loading";

export default {
    components: {
        Cover,
        Mempelai,
        Acara,
        Gallery,
        Protocol,
        FormGuestBook,
        Comment,
        Audio,
        Navbar,
        MusicBox,
        InfiniteLoading
    },

    data() {
        return {
            comments: [],
            page: 1,
            busy: false,
            loading: false,
            hasMore: true,
            total: 0,
        };
    },

    mounted() {
        // Load initial data
        this.loadInitialData();

        let prevScrollpos = window.pageYOffset;

        window.onscroll = () => {
            const currentScrollPos = window.pageYOffset;

            if (prevScrollpos > currentScrollPos) {
                document.getElementById("navbar").style.bottom = "0";
            } else {
                document.getElementById("navbar").style.bottom = "-78px";
            }
            prevScrollpos = currentScrollPos;
        }
    },

    methods: {
        async loadInitialData() {
            this.loading = true;
            try {
                const response = await axios.get(`comments?page=${this.page}&per_page=3`);
                const data = response.data;

                this.comments = data.data;
                this.page = data.current_page + 1;
                this.hasMore = data.has_more;
                this.total = data.total;
            } catch (error) {
                console.error('Error loading initial data:', error);
            } finally {
                this.loading = false;
            }
        },

        async loadMore($state) {
            if (this.busy || !this.hasMore) {
                if ($state) $state.complete();
                return;
            }

            this.busy = true;
            this.loading = true;

            try {
                const response = await axios.get(`comments?page=${this.page}&per_page=3`);
                const data = response.data;

                if (data.data && data.data.length > 0) {
                    this.comments.push(...data.data);
                    this.page = data.current_page + 1;
                    this.hasMore = data.has_more;

                    if ($state) $state.loaded();
                } else {
                    this.hasMore = false;
                    if ($state) $state.complete();
                }
            } catch (error) {
                console.error('Error loading more comments:', error);
                if ($state) $state.complete();
            } finally {
                this.busy = false;
                this.loading = false;
            }
        },

        addComment(comment) {
            this.comments.unshift(comment);
            this.total += 1;
        },
    },
};
</script>

<style scoped>
.text-thelast {
    color: rgba(206, 180, 108, 0.75);
}

.divider-thelast {
    margin: 0 auto;
    width: 15%;
    margin-top: 3px;
    border: 0;
    height: 1px;
    background-image: linear-gradient(
        to right,
        rgba(255, 255, 255, 0),
        rgba(206, 180, 108, 0.75),
        rgba(255, 255, 255, 0)
    );
}
</style>
