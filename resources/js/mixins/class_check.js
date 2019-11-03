
const classCheck = {
  props: {
    extra_class           : String,
  },
  data () {
    return {
      this_class        : '',
    }
  },
  mounted() {
    if (this.extra_class) {
      this.this_class = this.extra_class
    }
  },
}
export default classCheck;