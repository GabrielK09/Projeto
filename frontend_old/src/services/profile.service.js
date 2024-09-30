import axios from 'axios';
import Jsona from 'jsona';
import authHeader from './auth-header';

const API_URL = process.env.VUE_APP_API_BASE_URL;
const dataFormatter = new Jsona();

export default {
  async getProfile() {
    try {
      const response = await axios.get(API_URL + "/me", { headers: authHeader() });
      return dataFormatter.deserialize(response.data);
    } catch (error) {
      console.error('Error fetching profile:', error);
      // Retorne uma mensagem de erro ou um objeto vazio
      return { error: 'Não foi possível obter o perfil.' };
    }
  },

  async editProfile(profile) {
    try {
      profile.type = 'profile';
      const newJson = dataFormatter.serialize({ stuff: profile });
      const response = await axios.patch(API_URL + "/me", newJson, { headers: authHeader() });
      return dataFormatter.deserialize(response.data);
    } catch (error) {
      console.error('Error editing profile:', error);
      return { error: 'Não foi possível editar o perfil.' };
    }
  },

  async uploadPic(pic, userId) {
    try {
      const postUrl = API_URL + "/uploads/users/" + userId + "/profile-image";
      const response = await axios.post(postUrl, { attachment: pic }, { headers: { 'Content-Type': 'multipart/form-data' } });
      return response.data;
    } catch (error) {
      console.error('Error uploading picture:', error);
      return { error: 'Não foi possível fazer o upload da imagem.' };
    }
  }
}
