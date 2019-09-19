<template>
    <div class="panel-body">
        <vue-form-generator :schema="schema" :model="model" ref="dev"></vue-form-generator>
    </div>
</template>

<script>
    import Vue from 'vue'
    import { validators } from "vue-form-generator";
    import VueFormGenerator from "vue-form-generator/dist/vfg-core.js";
    import "vue-form-generator/dist/vfg-core.css";

    Vue.use(VueFormGenerator)

    VueFormGenerator.validators.unique_product_name = function(value, field, model) {
        if(value)
            return axios.get('/validate_product_name/' + model.name)
        .then(resp => { return [] } )
        .catch(resp => { return ['Product name should be unique']} )
    }

    export default {
        data () {
            return {
                model: {
                    id: '',
                    name: '',
                    description: '',
                    category_id: '',
                    price: '',
                    photo: ''
                },
                schema: {
                    fields: [
                    {
                        type: 'input',
                        inputType: 'text',
                        label: 'Name',
                        model: 'name',
                        maxlength: 64,
                        placeholder: 'Product name',
                        required: true,
                        validator: [validators.required, VueFormGenerator.validators.unique_product_name],
                        styleClasses: 'col-md-12'
                    },
                    {
                        type: 'input',
                        inputType: 'text',
                        label: 'Description',
                        model: 'description',
                        placeholder: 'Product description',
                        required: true,
                        validator: validators.required,
                        styleClasses: 'col-md-12'
                    },
                    {
                        type: 'select',
                        label: 'Category',
                        model: 'category_id',
                        values: [{id: '', name: ''}],
                        required: true,
                        validator: validators.required,
                        styleClasses: 'col-md-6',
                    },
                    {
                        type: 'input',
                        inputType: 'number',
                        label: 'Price',
                        model: 'price',
                        min: 0,
                        placeholder: "Product's price",
                        required: true,
                        validator: validators.required,
                        styleClasses: 'col-md-6'
                    },
                    {
                        type: "upload",
                        accept: "image/jpeg",
                        model: "photo",
                        inputName: "photo",
                        multiple: false,
                        styleClasses: 'col-md-12',
                    },
                    {
                        type: "submit",
                        styleClasses: 'offset-4 col-2',
                        buttonText: "Cancelar",
                        onSubmit(model, schema) {
                            model.id = '',
                            model.name = '',
                            model.description = '',
                            model.category_id = '',
                            model.price = '',
                            model.photo = ''
                        }
                    },
                    {
                        type: "submit",
                        styleClasses: 'col-2',
                        validateBeforeSubmit: true,
                        onSubmit(model, schema) {
                            let config = { headers: { 'content-type': 'multipart/form-data' } }
                            let photo = $('#photo')[0].files[0]
                            let formData = new FormData()

                            formData.append('name', model.name)
                            formData.append('description', model.description)
                            formData.append('category_id', model.category_id)
                            formData.append('price', model.price)
                            formData.append('photo', photo)

                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this!",
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            })
                            .then(() => {
                                axios.post('/products/', formData, config)
                                .then(() => Swal.fire('AEW COROI!', 'Product has been deleted.', 'success'))
                                .catch(() => Swal.fire('Error!', 'An error occurred in server. Try again!', 'error'))
                            })
                        }
                    }
                    ]
                }
            }
        },
        created() {
            axios.get('/categories/').then((res) => this.schema.fields[2].values = res.data)
        }
    }
</script>