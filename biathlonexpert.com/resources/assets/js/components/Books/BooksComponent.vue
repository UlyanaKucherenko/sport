<template>
  <section class="member-books">
    <div class="container">
      <MyPlan
          :locale="locale"
          :expirationData="expirationData"
          :totalBooks="totalBooks"
          :availableBooks="availableBooks"
          :planName="plan.slug"
          btnName="Upgrade"
      />

      <div class="member-books__wrap-pagination">
        <div class="member-books__title member-title">Recently downloaded books</div>
        <div class="pagination">
          <b-pagination-nav :link-gen="linkGen" :number-of-pages="last_page" v-model="currentPage"/>
        </div>
      </div>

      <div class="member-books__row">
        <div class="books-container">
          <div class="books-container__item" v-for="book in books" :key="book.id">
            <div class="books-container__img">
              <img :src="`/storage/${book.img}`" alt="">
              <a class="books-container__btn" :href="`books/${book.id}`" @mousedown="handleClick(book)">
                <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="28" cy="28" r="28" fill="red"/>
                  <path
                      d="M36.1666 24.5H31.4999V17.5H24.4999V24.5H19.8332L27.9999 32.6667L36.1666 24.5ZM19.8332 35V37.3333H36.1666V35H19.8332Z"
                      fill="white"/>
                </svg>
              </a>
            </div>
            <div class="books-container__text">{{ book.title }}</div>
          </div>
        </div>
      </div>

    </div>
    <popup-success
        msgText="Download limit reached"
        popup-type="error"
        :show-popup="showPopup"
        @closePopup="showPopup = !showPopup"
    ></popup-success>
  </section>
</template>

<script>


import vocab from '../../translates/member_area/ebooks';
import RecentBooks from '../Assets/RecentBooks';
import MyPlan from "../Assets/MyPlan";

export default {
  name: "BooksComponent",
  props: {
    props_books_data: {
      type: Object,
      require: true
    },
    totalBooks: {
      type: Number,
      require: true
    },
    availableBooks: {
      type: Number,
      require: true
    },
    expirationData: {
      type: String,
      require: true
    },
    routes: {},
    recentBooks: {
      type: Array
    },
    plan: {},
    downloadErrors: {
      type: String
    },
    locale: {
      type: String,
      require: true
    },
    planTexts: {},
    plans: {},
    planName: {
      type: String,
      require: true
    },
  },
  components: {MyPlan, RecentBooks},
  data() {
    return {
      vocab: vocab[this.locale],
      books_data: {},
      books: [],
      currentPage: null,
      first_page_url: null,
      last_page: null,
      last_page_url: null,
      next_page_url: null,
      path: null,
      per_page: null,
      prev_page_url: null,
      to: null,
      total: null,
      downloading: false,
      newDownloads: [],
      showPopup: false,
      showRecent: true,
      downloadedBooks: 0,
    }
  },
  created() {
    this.newDownloads = [...this.recentBooks];
    this.downloadedBooks = this.availableBooks;

    (
        {
          data: this.books,
          current_page: this.currentPage,
          first_page_url: this.first_page_url,
          last_page: this.last_page,
          last_page_url: this.last_page_url,
          next_page_url: this.next_page_url,
          path: this.path,
          per_page: this.per_page,
          prev_page_url: this.prev_page_url,
          to: this.to,
          total: this.total,
        } = this.props_books_data
    );

    if (this.downloadErrors.length > 2) {
      this.showPopup = 1;
    }
    this.downloadBooks();
  },

  methods: {
    linkGen(pageNum) {
      return '?page=' + pageNum
    },
    downloadBooks() {
      window.onscroll = () => {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
          console.log(true);
          // axios
        } else {
          console.log(false);
        }
      }
    },
    handleClick(book) {
      console.log('book', book)
      if (!this.newDownloads.find(function (element, index, array) { //finding similar elements in slider
        if (element.book.id === book.id) {
          return true;
        }
        return false;
      })) {
        this.downloadedBooks++;
        if (this.newDownloads.length < 5) {
          this.newDownloads.push({book: book, id: this.newDownloads.length + 1, book_id: book.id});
        }
      }
    },
  }
}
</script>

<style lang="scss">
</style>
