<template>
  <div class="component-container posts-container col-xs-12 col-md-12 col-lg-12">
    <div class="posts-container__switch btn btn-primary col-xs-4 col-md-4 col-lg-4" v-on:click="show" v-if="!visible">Show Comments</div>
    <div class="posts-container__switch btn btn-primary posts-container__switch--active col-xs-4 col-md-4 col-lg-4" v-on:click="hide" v-if="visible">Hide Comments</div>

    <div v-if="visible" class="col-xs-12 col-md-12 col-lg-12">
      <div class="posts-container__length">Comment Count: {{ comments.length }}</div>
      <ul class="posts-container__list" v-if="comments && comments.length">
        <li class="posts-container__list__item" v-for="comment in comments">
          <div class="posts-container__list__item__email">{{comment.email}} ({{comment.created_at}})</div>
          <div class="posts-container__list__item__text">{{comment.comment}}</div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
    export default {
        methods: {
          hide: function () {
            this.visible = false
          },
          show: function () {
            let self = this
            this.getData()
              .then(function (response) {
                self.visible = !self.visible
              })
          },
          getData: function () {
            if (this.post_id) {
              let self = this
              return new Promise((resolve, reject) => {
                this.$http.get('/dashboard/get-comments/?post_id=' + this.post_id)
                  .then(function (response) {
                    self.comments = response.data.comments
                    return resolve(response)
                  })
                  .catch(() => reject)
              })
            }
          }
        },
        props: ['post_id', 'count'],
        data: function () {
          return {
            id: '',
            comments: [],
            visible: false
          }
        },
        mounted: function () {
        }
    }
</script>

<style lang="stylus">
  .posts-container
    border-left 1px solid light-gray
    display block
    margin 0.2rem 0
    padding 0.6rem

    &__switch
      cursor pointer
      padding 1rem
    &__length
       display block
       font-weight 600
       padding 1rem 0
    &__list
        list-style-type none
        padding-left 0.5rem
        &__item
          display block
          &__email
            font-weight 600
          &__text
            color gray

</style>