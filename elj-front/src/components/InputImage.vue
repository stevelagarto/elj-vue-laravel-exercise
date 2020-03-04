<template>
  <div>
    <b-jumbotron header="Upload Image" lead="Upload image for color analisis">
      <input type="file" accept="image/*" @change="uploadImage($event)" id="file-input">
      <div id="preview">
        <img class="uploaded-image" v-if="item.imageUrl" :src="item.imageUrl" />
      </div>
    </b-jumbotron>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    return {
      item: {
        image: null,
        imageUrl: null
      }
    }
  },
  methods: {
    uploadImage (event) {
      event.preventDefault()
      console.log('UPLOADING IMAGE')
      const file = event.target.files[0]
      this.image = file
      this.item.imageUrl = URL.createObjectURL(file)
      const backURL = 'http://localhost:8000/api/analize_image'

      let data = new FormData()
      data.append('name', 'my-picture')
      data.append('file', event.target.files[0])

      let config = {
        header: {
          'Content-Type': 'image/png'
        }
      }

      axios.post(
        backURL,
        data,
        config
      ).then(
        response => {
          console.log('image upload response > ', response)
        }
      )
    }
    // formSubmit (e) {
    //   e.preventDefault()
    //   axios({
    //     method: 'post',
    //     url: 'http://localhost:8000/api/analize_image',
    //     data: 'PASSED',
    //     config: {
    //       headers: {
    //         'Content-Type': 'text/plain'
    //       }
    //     }
    //   })
    //     .then(response => {
    //       this.form.text = response.data
    //     })
    //     .catch(e => {
    //       this.errors.push(e)
    //     })
    // }
  }
}

</script>

<style scoped>
.uploaded-image {
  max-width: 200px;
}
</style>
