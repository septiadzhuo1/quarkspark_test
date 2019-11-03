<template>
  <div class=" inputHolder" >
    <div class="row">
      <div :class="input_class" style="width:100%;">
        <select class="form-control" :name="this_name" :id="this_id" :required="this.required">
          <option v-if="this_default_text" :value="default_value" selected="selected">
            {{ this_default_text }}
          </option>
          <option  v-for="option in options" v-bind:key="option.index" :value="option.value" :selected="checkSelected(option.value)">
            <template v-if="option.text">
              {{ option.text  }}
            </template>
            <template v-else >
              {{ option.value }}
            </template>
          </option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>

import commonMethod from '../../mixins/common-method'

// this mixin make dynamic id and name whether got index or not
import idNameIndex from '../../mixins/id_name_index'
// returns this_id && this_name

// this mixin check if class exist
import classCheck from '../../mixins/class_check'
// returns this_class

export default {
  mixins : [commonMethod, idNameIndex, classCheck],
  props : {
    value           : String,
    placeholder     : String,
    options_json    : [String, Array, Object], 
    readonly        : Boolean,
    compsize        : String, 
    default_text    : [String, Number], 
    default_value   : [String, Number],
    default_select  : [String, Number],
    required        : Boolean,
  },
  data () {
    return {
      this_value    : null,
      this_row      : 3, 
      label_class   : 'customLabel col-2 p-0',
      input_class   : '',
      options       : null,  
      this_default_text  : null, 
      this_select   : null,
    }
  },
  mounted () {
 
    if (!this.readonly) {
      this.readonly         = false
    }
    
    if (this.compsize == 'small') {
      this.label_class      = 'customLabel col-4 p-0'
      this.input_class      = 'textInput col-8 p-0'
    }

    if (this.index) {
      this.this_name        = `${this.name}_${this.index}`
      this.this_id          = `${this.id}_${this.index}`
    }
   
    if (this.options_json) {
      this.options = JSON.parse(this.options_json)
    } 
    
    
    if (this.default_text) {
      this.this_default_text = this.default_text
    }
    
    this.getValue();
  },
  updated () {
    
    this.getValue();
  },

  watch: {
    options_json : function (val) {
      this.options = this.options_json
      // console.log('changed value : ' + val)
    },
  },

  methods: {
    checkSelected (check) {
      if (this.default_select) {
        if (this.default_select == check) {
          return 'selected'
        }
      }
    }
  }

}
</script>

<style lang="scss" scoped>
  @import "../../../sass/_includes.scss";

</style>
