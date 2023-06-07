<template>
  <h2>Raccourcisseur d'url</h2>
<div class="container contenu">
  <form @submit.prevent="submitForm">
    <input class="form-control" type="text" v-model="url" placeholder="Entrez votre URL">
    <br><br>
    <button class="btn btn-block btn-primary" type="submit">Envoyer</button>
  </form>
</div>
<br>
<p>Url raccourci !!!!!</p>
<h3 v-if="response">{{ response.message }}</h3>
<h3 v-if="response[0]"> <a :href="response[0].url_final">{{ response[0].url_final }}</a> </h3>
<h3 v-if="response.url_final"> <a  :href="response.url_final">{{ response.url_final }}</a> </h3>
</template>

<script>

export default {
  data() {
    return {
      url: '',
      response: {},
      clickCount: 0,
      apiResponse: null
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/url', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ url: this.url })
        });

        if (response.ok) {
          // La requête a réussi
          const jsonResponse = await response.json();
          this.response = jsonResponse;
          console.log('Réponse de l\'API:', this.response);
        } else {
          // La requête a échoué
          console.error('Une erreur s\'est produite lors de l\'envoi de la requête.');
        }
      } catch (error) {
        console.error('Une erreur s\'est produite lors de l\'envoi de la requête.', error);
      }
    },
  }
};
</script>
<style>
.contenu{
  margin-top: 10%;
}

</style>
