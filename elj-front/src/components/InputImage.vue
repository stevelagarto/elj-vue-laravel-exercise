<template>
  <div>
    <b-jumbotron class="jumbotron">
      <div class="up-title">Upload an image to see the average color and the nearest predefined color</div>
      <b-form-file
      v-model="file"
      :state="Boolean(file)"
      placeholder="Choose an image file..."
      drop-placeholder="Drop file here..."
      @change="uploadImage($event)"
      accept="image/*"
      size="lg"
      no-drop
    ></b-form-file>
    <div class="error-message" v-if="sizeError">{{sizeError}}</div>
    </b-jumbotron>
    <div id="preview" class="image-container">
      <div>
        <img class="uploaded-image" v-if="item.imageUrl" :src="item.imageUrl" />
        <div v-if="item.imageUrl">Original</div>
      </div>
      <div v-if="averageColor">
        <div  class="square-color" v-bind:style="{ 'background-color': averageColor }"></div>
        <div>Average Color</div>
        <div>{{averageColor}}</div>
      </div>
      <div v-else class="square"></div>
      <div v-if="nearestColor">
        <div  class="square-color" v-bind:style="{ 'background-color': nearestColor }"></div>
        <div>Nearest color: {{nameColor}}</div>
        <div>{{nearestColor}}</div>
      </div>
      <div v-else class="square"></div>
    </div>
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
      },
      nearestColor: null,
      averageColor: null,
      nameColor: null,
      file: null,
      sizeError: null,
      loading: null
    }
  },
  methods: {
    uploadImage (event) {
      event.preventDefault()
      if (event.target.files[0].size / 1024 / 1204 > 1.5) {
        this.sizeError = 'Maximum size exceeded (1.5Mb)'
      } else {
        this.sizeError = null
        this.file = event.target.files[0]
        this.image = this.file
        this.item.imageUrl = URL.createObjectURL(this.file)

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
            this.nearestColor = response.data[0]
            this.nameColor = response.data[1]
            this.averageColor = response.data[2]
          }
        ).catch()
        this.file = null
      }
    }
  }
}

</script>

<style scoped>
.up-title {
  padding-bottom: 10px;
}
.title {
  font-size: 30px;
  font-weight: 600;
  margin-bottom: 50px;
}
.image-container {
  display: flex;
  justify-content: center;
}
.uploaded-image {
  max-height: 200px;
  height: 200px;
  margin: 30px;
  margin-bottom: 10px;
  border: 1px solid #e2e2e2
}
.square-color {
  width: 200px;
  height: 200px;
  margin: 30px;
  margin-bottom: 10px;
  border: 1px solid #e2e2e2
}
.square {
  width: 200px;
  height: 200px;
  margin: 30px;
  margin-bottom: 10px;
}
.error-message {
  color: rgb(250, 99, 99);
  margin-top:5px;
}
.jumbotron {
  min-height: 250px;
}
</style>
