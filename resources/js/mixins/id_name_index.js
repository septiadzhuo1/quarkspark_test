
const idNameIndex = {
  props: {
    id                  : String,
    name                : String,
    index               : [String, Number],
  },
  data () {
    return {
      this_id           : null,
      this_name         : null,
    }
  },
  mounted() {
    if (this.id) {
      this.this_id         = this.id
    }
    if (this.name) {
      this.this_name        = this.name
    }

    if(!this.id && this.name) {
      this.this_id          = this.name
    } 
    if (!this.name && this.id) {
      this.this_name        = this.id
    }
    
    if (this.index) {
      this.this_id          = `${this.id}_${this.index}`
      this.this_name        = `${this.name}_${this.index}`
    }
  },
  updated () {
    if (this.index) {
      this.this_id          = `${this.id}_${this.index}`
      this.this_name        = `${this.name}_${this.index}`
    }
  }
}
export default idNameIndex;