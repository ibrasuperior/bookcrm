class Report extends React.Component {
    
    state ={ 
        isLoading: false,
        error: null,
        users : [],
        midias : [],
        estagios: [],
        colaborador_id : '',
        midia : '',
        estagio :'',
        valores : '',
        produto : '',
        dataInicio :'',
        dataFinal :'',
    }


    async componentDidMount(){
        await axios.get(`/api/users`)
        .then(res => {
            this.setState({ users : res.data });
        })

        await axios.get(`/api/userAttempt`)
        .then(res => {
            this.setState({ userAttempt : res.data });
        })

        await axios.get(`/api/estagios`)
        .then(res => {
            this.setState({ estagios : res.data });
        })

        await axios.get(`/api/midias`)
        .then(res => {
            this.setState({ midias : res.data });
        })
        
    }

    handleSubmit = async (e) => {
        e.preventDefault()
        
        try{
            this.setState({isLoading: true})
            await axios({
                url: 'http://localhost:8000/api/export',
                method: 'POST',
                responseType: 'blob',
                data: {
                    colaborador_id : this.state.colaborador_id,
                    aquisicao_id : this.state.midia,
                    estagio : this.state.estagio,
                    dataInicio : this.state.dataInicio.toString(),
                    dataFinal : this.state.dataFinal.toString(),
                }
              }).then((response) => {
                if( response.status == 200 ){
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'report.xlsx');
                    document.body.appendChild(link);
                    link.click();
                }else{
                    console.log(response.error)
                }
                
              })

        }catch(err){
            console.log(err.message)
        }finally{
            this.setState({isLoading :  false })
        }
    }

    render() {
        const {midias, users, isLoading, estagios} = this.state;
        return (
            <form className="col-md-6 offset-md-3" onSubmit={this.handleSubmit}>
            <div className="form-group">
                <label >Operador:</label>
                <select className="form-control" name="colaborador_id" value={this.state.colaborador_id}
                onChange={ e => this.setState({ colaborador_id : e.target.value})  } >
                    <option>Todos</option>
                    { users.map( user => 
                            <option key={user.id} value={user.id}> { user.name }</option>
                        ) }
                </select>
            </div>

            <div className="form-group">
                <label>Mídia:</label>
                <select className="form-control" ref="midia" value={this.state.midia}
                onChange={ e => this.setState({ midia : e.target.value})  } >
                    <option>Todos</option>
                    { midias.map( midia => 
                            <option key={midia.id} value={midia.id}> { midia.nome }</option>
                        ) }
                </select>
            </div>

            <div className="form-group">
                <label>Estágio:</label>
                <select className="form-control" ref="estagio" value={this.state.estagio}
                onChange={ e => this.setState({ estagio : e.target.value})  } >
                    <option>Todos</option>
                    { estagios.map( estagio => 
                            <option key={estagio.id} value={estagio.id}> { estagio.nome }</option>
                        ) }
                </select>
            </div>

            <div className="form-group">
                <label>Pagamento:</label>
                <select className="form-control" id="exampleFormControlSelect1">
                <option>Todos</option>
                <option>Valor à vista</option>
                <option>Boleto</option>

                </select>
            </div>

            <div className="form-group">
                <label>Produto:</label>
                <select className="form-control" id="exampleFormControlSelect1">
                <option>Todos</option>
                <option>Pós-Graduação</option>
                <option>Capacitação</option>
                <option>Complementação</option>

                </select>
            </div>

            <div className="form-group">
            <label>Período:</label>
            <label className="ls-label">
                <b className="ls-label-text">De:</b>
                <input type="date" value={this.state.dataInicio}
                onChange={ e => this.setState({ dataInicio : e.target.value})  } className="datepicker ls-daterange" placeholder="dd/mm/aaaa" id="datepicker1" data-ls-daterange="#datepicker2"  />
            </label>

            <label className="ls-label">
                <b className="ls-label-text">Até:</b>
                <input className="datepicker ls-daterange" id="datepicker2" type="date" value={this.state.dataFinal}
                onChange={ e => this.setState({ dataFinal : e.target.value})  }  />
            </label>
            </div>

                <button
                    className="ls-ico-stats ls-btn ls-btn-primary ls-btn-block"
                    onClick={this.onSubmit}
                    disabled={this.state.isLoading}
                >
                    {this.state.isLoading ? "Carregando..." : "Exportar para Excel"}
                </button>

            </form>
        );
    }
}


ReactDOM.render(
    <Report />,
    document.getElementById('report')
);

