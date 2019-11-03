const commonMethod = {
  methods: {
    getValue () {
      if (this.this_value === null) {
        this.this_value = this.value
      }
    },
    getTableData (data) {
      if (data) {
        this.table_data = data
        // console.log(typeof JSON.parse(this.table_data))
      }
    },
    escapeJSON (json_string) {
      // console.log(json_string)
      json_string.replace(/\\n/g, "\\n")
                                      .replace(/\\'/g, "\\'")
                                      .replace(/\\"/g, '\\"')
                                      .replace(/\\&/g, "\\&")
                                      .replace(/\\r/g, "\\r")
                                      .replace(/\\t/g, "\\t")
                                      .replace(/\\b/g, "\\b")
                                      .replace(/\\f/g, "\\f");
      return json_string
    },
    flashMessage(data) {
      $('#loader').slideUp(500);
      $('div.flash-message').hide();
      $('div.flash-message').html(data);
      $('div.flash-message').slideDown(1000);
      setTimeout(() => {
        $('div.flash-message').slideUp(2000);
      }, 5000)
    },
    hasDefaultSlot () {
      return !!this.$slots.default
    },
    getDefaultSlot () {
      return this.$slots.default[0].text.trim()
    },
    replaceUnderscore(value) {
      return value.replace(/_/g, ' ')
    }
    
  }
}
export default commonMethod;