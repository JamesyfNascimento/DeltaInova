import React from 'react';
import { Row, Form, Col, Button } from 'react-bootstrap';

class AddAluno extends React.Component {
    constructor(props) {
        super(props);

        this.estadoInicial = {
            matricula: '',
            nome: '',
            avatar: ''
        }

        if (props.user.matricula) {
            this.state = props.user
        } else {
            this.state = this.estadoInicial;
        }

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);

    }

    handleChange(event) {
        const name = event.target.name;
        const value = event.target.value;

        this.setState({
            [name]: value
        })
    }

    handleSubmit(event) {
        event.preventDefault();
        this.props.onFormSubmit(this.state);
        this.setState(this.estadoInicial);
    }
    render() {
        let TituloPagina;
        let statusAcao;
        if (this.state.matricula) {

            TituloPagina = <h2>Editar Aluno</h2>
            statusAcao = <b>Atualizar</b>
        } else {
            TituloPagina = <h2>Adicionar Aluno</h2>
            statusAcao = <b>Salvar</b>
        }

        return (
            <div>
                <h2> {TituloPagina}</h2>
                <Row>
                    <Col sm={7}>
                        <Form onSubmit={this.handleSubmit}>
                            <Form.Group controlId="nome">
                                <Form.Label>Nome</Form.Label>
                                <Form.Control
                                    type="text"
                                    name="nome"
                                    value={this.state.nome}
                                    onChange={this.handleChange}
                                    placeholder="Nome" />
                            </Form.Group>
                            <Form.Group controlId="avatar">
                                <Form.Label>Avatar</Form.Label>
                                <Form.Control
                                    type="text"
                                    name="avatar"
                                    value={this.state.avatar}
                                    onChange={this.handleChange}
                                    placeholder="Avatar" />
                            </Form.Group>
                            <Form.Group>
                                <Form.Control type="hidden" name="matricula" value={this.state.matricula} />
                                <Button variant="success" type="submit">{statusAcao}</Button>

                            </Form.Group>
                        </Form>
                    </Col>
                </Row>
            </div>
        )
    }
}

export default AddAluno;