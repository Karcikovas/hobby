import * as types from '../actions/types';

const initialState = {
  username: '',
  email: '',
  password: '',
  password2: '',
  loading: false,
  error: ''
}

export default (state = initialState, action) => {
  switch (action.type) {
    case types.REGISTER_FORM_INPUT_CHANGE:
      return {...state, [action.name]: action.value};
    case types.REGISTER_FORM_LOADING:
      return {...state, error:'', loading: true};
    case types.REGISTER_FORM_ERROR:
      return {...state, error: action.error, loading:false};
    case types.REGISTER_FORM_SUCCESS:
      return {...state, username: '', email: '', password: '', password2: '', error: '', loading: false}
    default:
      return state;
  }
}