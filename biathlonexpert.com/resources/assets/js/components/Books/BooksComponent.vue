<template>
  <section class="member-books">
    <div class="container">
      <MyPlan
          :local="locale"
          :expirationData="expirationData"
          :totalBooks="totalBooks"
          :availableBooks="availableBooks"
          :planName="plan.slug"
          btnName="Upgrade"
      />

      <div class="member-books__wrap-pagination">
        <div class="member-books__title">Recently downloaded books</div>
        <div class="pagination">
          <b-pagination-nav :link-gen="linkGen" :number-of-pages="last_page" v-model="currentPage"/>
        </div>
      </div>

      <div class="member-books__row">
        <div class="books-container">
          <div class="books-container__item" v-for="book in books" :key="book.id">
            <div class="books-container__img">
              <img :src="`/storage/${book.img}`" alt="">
            </div>
            <div class="books-container__text">{{ book.title }}</div>
            <a class="books-container__btn" :href="`books/${book.id}`" @mousedown="handleClick(book)">
              <img src="/img/errow-download.svg"/>
            </a>
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
<<<<<<< HEAD

=======
>>>>>>> 3762fcf9d4294606746b45467f52d3c8442afeae
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
    console.log('data',this.books)
    console.log('last_page',this.props_books_data.last_page)

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
