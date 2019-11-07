import React, { Component } from 'react';

import { Container, Button } from 'react-bootstrap';
import AlunoList from './get';
import AddAluno from './add';
import axios from 'axios';
const apiUrl = 'https://psdeltainova.000webhostapp.com/index.php/AlunoController/';

class AlunoAcoesApp extends Component {
  constructor(props) {
    super(props);

    this.state = {
      isAddAluno: false,
      error: null,
      alunos: {},
      alunoData: {},
      isEditarAluno: false,
      isAlunos: true,
    }

    this.onFormSubmit = this.onFormSubmit.bind(this);

  }

  componentDidMount() {
        fetch(apiUrl + 'listarTodos')
            .then(res => res.json())
            .then((data) => {
                this.setState({ alunos: data })
            },
                (error) => {
                    this.setState({ error });
                })
    }

  onCreate() {
    this.setState({ isAddAluno: true });
    this.setState({ isAlunos: false });
  }
  onDetails() {
    this.setState({ isAlunos: true });
    this.setState({ isAddAluno: false });
  }

  onFormSubmit(data) {
    this.setState({ isAddAluno: false });
    this.setState({ isAlunos: true });
    let body = {
      matricula: data.matricula,
      nome: data.nome,
      avatar: data.avatar
    };
    if (this.state.isEditarAluno) {
      fetch(apiUrl + 'editarAluno/' + data.matricula, {
        method: 'POST',
        body: JSON.stringify(body)
      })
        .then(res => res.json())
        .then((data) => {
          if (data.Success == true) {
            fetch('https://psdeltainova.000webhostapp.com/index.php/AlunoController/listarTodos')
              .then(response => {
                return response.json();
              }).then(result => {
                this.setState({
                  alunos: result,
                  isAddAluno: false,
                  isEditarAluno: false
                });
              });

          } else {
            alert(data.mensagem)
          }
        },
          (error) => {
            this.setState({
              error: error,
              isAddAluno: false,
              isEditarAluno: false,
              isAluno: true
            });
          })
    } else {
      console.log(body);
      fetch(apiUrl + 'adicionarAluno/', {
        method: 'POST',
        body: JSON.stringify(body)
      })
        .then(res => res.json())
        .then((data) => {
          if (data.Success == true) {
            fetch('https://psdeltainova.000webhostapp.com/index.php/AlunoController/listarTodos')
              .then(response => {
                return response.json();
              }).then(result => {
                this.setState({
                  alunos: result,
                  isAddAluno: false,
                  isEditarAluno: false
                });
              });

          } else {
            alert(data.mensagem)
          }
        },
          (error) => {
            this.setState({
              error: error,
              isAddAluno: false,
              isEditarAluno: false,
              isAluno: true
            });
          })
    }

  }



  editarAluno = matricula => {
    this.setState({ isAlunos: true });

    fetch(apiUrl + 'aluno/' + matricula, {
      method: 'get'
    })
      .then(res => res.json())
      .then((data) => {
        this.setState({
          isEditarAluno: true,
          isAddAluno: false,
          alunoData: data
        });
      },
        (error) => {
          this.setState({ error });
        })
  }

  render() {

    let alunoForm;
    if (this.state.isAddAluno || this.state.isEditarAluno) {

      alunoForm = <AddAluno onFormSubmit={this.onFormSubmit} user={this.state.alunoData} />

    }
    return (
      <div className="App">
        <Container>
          <h1 style={{ textAlign: 'center' }}>Controle de alunos</h1>
          <hr></hr>
          {!this.state.isAlunos && <Button className="mr-3" variant="primary" onClick={() => this.onDetails()}> Listagem</Button>}
          {!this.state.isAddAluno && <Button variant="primary" onClick={() => this.onCreate()}>Add Aluno</Button>}
          <br></br>
          {!this.state.isAddAluno && <AlunoList editarAluno={this.editarAluno} alunos={this.state.alunos}/>}
          {alunoForm}
        </Container>
      </div>
    );
  }
}
export default AlunoAcoesApp; 