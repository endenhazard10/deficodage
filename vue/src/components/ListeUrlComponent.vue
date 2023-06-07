<template>
    <div>
    <div class="container">
    <h1>Tableau récapitulatif</h1>
    <br>
        <table class="table">
        <thead class="thead-dark">
            <tr class="table-info">
            <th scope="col">url</th>
            <th scope="col">Url final</th>
            <th scope="col">Nombre de click</th>
            </tr>
        </thead>
        <tbody>
          <tr class="table-primary" v-for="element in elements" :key="element.id">
            <td><a @click="incrementClickCount(element.id)">{{ element.url }}</a></td>
            <td><a @click="incrementClickCount(element.id)" :href="element.url" target="_blank">{{ element.url_final }}</a></td>
            <th scope="col">{{ element.click }}</th>
          </tr>
        </tbody>
        </table>
    </div>
  </div>
  </template>
  
  <script>
  import axios from 'axios';
  export default {
    data() {
      return {
        elements: [],
        clickCount: 0,
        apiResponse: null,
      };
    },
    created() {
      this.fetchData();
    },
    methods: {
      fetchData() {
        fetch('http://127.0.0.1:8000/api/url-liste')
          .then(response => response.json())
          .then(data => {
            this.elements = data;
          })
          .catch(error => {
            console.error(error);
          });
      },
      incrementClickCount(elementId) {
    const element = this.elements.find(el => el.id === elementId);
    if (element) {
      element.clickCount = element.clickCount ? element.clickCount + 1 : 1;
      this.sendClickCount(element);
      element.clickCount=0;
    }
  },
  sendClickCount(element) {
    const apiUrl = 'http://127.0.0.1:8000/api/compter';
    
    axios.post(apiUrl, { id: element.id, clickCount: element.clickCount })
      .then(response => {
        this.fetchData();
        this.apiResponse = response.data;
        console.log('Le nombre de clics a été envoyé avec succès !');
        console.log('Réponse de l\'API :', this.apiResponse);
      })
      .catch(error => {
        console.error('Une erreur s\'est produite lors de l\'envoi du nombre de clics :', error);
      });
  }

    }
  };
  </script>
  