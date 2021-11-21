<template>
  <div class="card card-info card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0 bg-transparent">
      <ul class="nav nav-tabs" id="steps" role="tablist">
        <li class="nav-item col-4 p-0">
          <a class="nav-link active" id="step-1" role="tab" aria-selected="true">
            Step 1 - Product Details
          </a>
        </li>
        <li class="nav-item col-4 p-0">
          <a class="nav-link disabled" id="step-2" role="tab" aria-selected="false">
            Step 2 - Product Images
          </a>
        </li>
        <li class="nav-item col-4 p-0">
          <a class="nav-link disabled" id="step-3" role="tab" aria-selected="false">
            Step 3 - Product Timestamp
          </a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content">
        <div id="step-1-content" class="tab-pane fade show active" role="tabpanel">
          <form @submit.prevent="validate(1)" class="mb-4 px-5 py-3 mx-5" novalidate="novalidate">
            <div class="form-group row">
              <label class="col-3 col-form-label" for="product-name">Product Name</label>
              <div class="col-9">
                <input id="product-name" type="text" class="pinput form-control" placeholder="" 
                  aria-describedby="name-error" aria-invalid="true"
                  v-model="product.name">
                <span id="name-error" class="error invalid-feedback" >asdf</span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-3 col-form-label" for="product-name">Product Category</label>
              <div class="col-9">
                <input id="product-category" type="text" class="pinput form-control" placeholder="" 
                  v-model="product.category">
                <span id="category-error" class="error invalid-feedback" ></span>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-3 col-form-label" for="summernote">Product Description</label>
              <div class="col-9">
                <textarea class="pinput" id="product-description" v-model="product.description">                Place &lt;em&gt;some&lt;/em&gt; &lt;u&gt;text&lt;/u&gt; &lt;strong&gt;here&lt;/strong&gt;
                </textarea>
                <span id="description-error" class="error invalid-feedback" style="">asdf</span>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-flat float-right">Next</button>
            </div>
          </form>
        </div>
        <div id="step-2-content" class="tab-pane fade" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
        </div>
        <div id="step-2-content" class="tab-pane fade" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>
</template>

<script>

window.onload = function(){
  $('#product-description').summernote({
    height: 200,
  });
}

let p=window.product;

import datetime from 'vuejs-datetimepicker';

export default {
  components: {
    datetime
  },
  data(){
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      product: {
        id: p.pid,
        name: p.name,
        description: p.description,
        category: p.category,
        datetime: p.datetime,
      },
      product_id: '',
      pagination: {},
      edit: false
    }
  },
  methods: {
    validate(step){
      let htmlDesc = $("#product-description").summernote('code');
      this.product.description = htmlDesc == "<p><br></p>" ? "" : htmlDesc;
      
      fetch('/api/product/validate/nameCatDesc', {
        method: 'post',
        headers:{
          "Accept": "application/json",
          "Content-Type": "application/json",
          "Authorization": "Bearer 5|kRzviKkNqcxrBCEaoVEh2I60NzFbpsSKa5EMg4hr",
          'X-CSRF-TOKEN': this.csrf,
        },
        body: JSON.stringify(this.product)
      })
      .then(res => res.json())
      .then(data => {
        let errors = data.errors
        if(errors){
          let errorFields = Object.keys(data.errors)
          if( errorFields.length > 0 ){
            $(".pinput, .note-editor").removeClass("border border-danger is-invalid")
              console.log(errors)
            errorFields.forEach(f => {
              $("#product-"+f).addClass("is-invalid")
              $("#"+f+"-error").html(errors[f].join(", "));
              if(f == "description"){
                $(".note-editor").addClass("border border-danger")
              }
            });
          }
        } else {
          $(".pinput, .note-editor").removeClass("border border-danger is-invalid")
        }
      })
      .catch(error => console.log(error));
    },
    addProduct(){
      if(this.edit === false){
        // Add
        fetch('/api/product', {
          method: 'post',
          headers: { 
            "Accept": "application/json",
            "Content-Type": "application/json",
            "Authorization": "Bearer 5|kRzviKkNqcxrBCEaoVEh2I60NzFbpsSKa5EMg4hr",
            'X-CSRF-TOKEN': this.csrf,
          },
          body: JSON.stringify(this.product)
        })
        .then(res => res.json())
        .then(data => {
          // @TODO redirect
          alert('Product Created');
        })
        .catch(error => console.log(error));
      } else {
        // Edit
      }
    }
  },
  created() {
  },
}
</script>