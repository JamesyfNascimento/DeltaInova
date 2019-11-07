
import React from 'react';
import { Table, Button } from 'react-bootstrap';
import axios from 'axios';

const apiUrl = 'https://psdeltainova.000webhostapp.com/index.php/AlunoController/';

class AlunoList extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            error: null,
            alunos: [],
            response: {}

        }
    }

    componentWillReceiveProps(props) {
        this.setState({ alunos: props.alunos })
      }

    deleteAluno(matricula) {

        if (window.confirm("Têm certesa que deseja deletar?")) {
            fetch('https://psdeltainova.000webhostapp.com/index.php/AlunoController/removerAluno/' + matricula, {
                method: 'post'
            }).then(response => {
                if (response.status === 200) {
                    alert("aluno deletado com sucesso");
                    fetch('https://psdeltainova.000webhostapp.com/index.php/AlunoController/listarTodos')
                        .then(response => {
                            return response.json();
                        }).then(result => {
                            this.setState({
                                alunos: result
                            });
                        });
                }
            }).catch(err => {
                if (err.name === 'AbortError') {
                    console.error('Fetch aborted')
                } else {
                    console.error('Another error', err)
                }
            });
        }
    }


    render() {
        const { error, alunos } = this.state;
        if (error) {
            return (
                <div>Error:{error.message}</div>
            )
        }
        else {
            return (
                <div>

                    <Table>
                        <thead className="btn-dark">
                            <tr>
                                <th>Matrícula</th>
                                <th>Nome</th>
                                <th>Avatar</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            {alunos.map(aluno => (
                                <tr key={aluno.matricula}>
                                    <td>{aluno.matricula}</td>
                                    <td>{aluno.nome}</td>
                                    <td>{aluno.avatar}</td>
                                    <td><Button className="mr-3" variant="info" onClick={() => this.props.editarAluno(aluno.matricula)}>Editar</Button>
                                        <Button variant="danger" onClick={() => this.deleteAluno(aluno.matricula)}>Deletar</Button>

                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </Table>
                </div>
            )
        }
    }
}

export default AlunoList;  
