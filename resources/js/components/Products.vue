<template>
  <div>
    <!-- ITEM LIST -->
    <div class="card card-default" v-for="product in products" v-bind:key="product.id">
      <div class="card-header bg-transparent">
        <h3 class="card-title mb-0">{{ product.name }}</h3>
        <div class="card-tools">
          <button class="btn btn-tool"
            @click="editProduct(product.id)">
            <i class="fas fa-pencil-alt"></i>
          </button>
          <button class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" title="Delete" style="color: red"
            @click="deleteProduct(product.id)">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <p>{{ product.description }}</p>
      </div>
    </div>

    <!-- PAGINATION -->
    <ul class="pagination">
      <li v-bind:class="[{disabled: !pagination.prev_page_url}]" 
        class="paginate_button page-item">
        <a href="#" tabindex="0" class="page-link"
          @click="fetchProducts(pagination.prev_page_url)">
          Previous
        </a>
      </li>
      <li class="paginate_button page-item disabled text-dark">
        <a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">
          Page {{ pagination.current_page }} of {{ pagination.last_page }}
        </a>
      </li>
      <li v-bind:class="[{disabled: !pagination.next_page_url}]" 
        class="paginate_button page-item">
        <a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link"
          @click="fetchProducts(pagination.next_page_url)">
          Next
        </a>
      </li></ul>
  </div>
</template>

<script>
let term = window.search;

export default {
  data(){
    return {
      keyword: term,
      products: [],
      product: {
        id: '',
        name: '',
        desc: ''
      },
      product_id: '',
      pagination: {},
      edit: false
    }
  },

  created() {
    if( this.keyword !== ""){
      this.searchProducts();
    } else {
      this.fetchProducts();
    }
  },

  methods: {
    searchProducts(){
      let keySearch = encodeURI(this.keyword);
      let uri = "/api/products/search/" + keySearch;
      this.fetchProducts(uri);
    },
    fetchProducts(page_url){
      let fp = this;
      page_url = page_url || "/api/products";
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.products = res.data;
          fp.makePagination(res.meta, res.links);
        })
        .catch(error => console.log(error));
    },
    makePagination(meta, links){
      // @TODO search pagination meta

      let pg = {
        current_page: meta.current_page,
        last_page: meta.last_page,
        next_page_url: links.next,
        prev_page_url: links.prev
      }

      this.pagination = pg;
    },
    deleteProduct(id){
      if(confirm('Are you Sure?')){
        fetch(`/api/product/${id}`, {
            method: 'delete',
            headers: { 
              "Content-Type": "application/json",
              "Authorization": "Bearer 5|kRzviKkNqcxrBCEaoVEh2I60NzFbpsSKa5EMg4hr",
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
          })
          .then(res => res.json())
          .then(data => {
            alert('Product has been removed.');
            this.fetchProducts('/api/products?page=' + this.pagination.current_page);
          })
          .catch(error => console.log(error));
      }
    },
    editProduct(id){
      window.location.href = "/product/"+id+"/edit";
    }
  }
}
</script>
