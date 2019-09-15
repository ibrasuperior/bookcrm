class Analytics extends React.Component{
    state ={
        filter: [],
        inicio: '',
        final: ''
    }
    
    async componentDidMount(){
        const response = await axios.post(`/api/analise`,{
            "inicio" : "02/09/2019",
	        "final" : "16/09/2019"
        })
        this.setState({ filter : response.data })
        console.log(this.state.filter)
    }

    render(){
        return(
            <div>
            <h2> Análise de Canais </h2> <hr/>
            <div className="col-md-8">
                <form className="ls-form ls-form-inline row">
                <label className="ls-label col-md-4 col-sm-12">
                    <div className="ls-prefix-group">
                    <span data-ls-module="popover" data-content="Escolha o período desejado e clique em 'Filtrar'." />
                    <input type="date" name="range_start" className="datepicker ls-daterange" placeholder="dd/mm/aaaa" id="datepicker1" data-ls-daterange="#datepicker2" />
                    <a className="ls-label-text-prefix ls-ico-calendar" data-trigger-calendar="#datepicker1" href="#" />
                    </div>
                </label>
                <label className="ls-label col-md-4 col-sm-12">
                    <div className="ls-prefix-group">
                    <span data-ls-module="popover" data-content="Clique em 'Filtrar' para exibir  o período selecionado." />
                    <input type="date" name="range_end" className="datepicker ls-daterange" placeholder="dd/mm/aaaa" id="datepicker2" />
                    <a className="ls-label-text-prefix ls-ico-calendar" data-trigger-calendar="#datepicker2" href="#" />
                    </div>
                </label>
                <div className="ls-actions-btn">
                    <button className="ls-btn-primary">Filtrar</button>
                </div>
                </form>
            </div>
            <table className="ls-table  ls-bg-header ">
                <thead>
                <tr>
                    <th className="ls-txt-center">#</th>
                    <th className="ls-txt-center">Leads</th>
                    <th className="ls-txt-center">Vendas</th>
                    <th className="ls-txt-center">Conversão</th>
                    <th className="ls-txt-center">Pós-Graduação</th>
                    <th className="ls-txt-center">Seg. Licenciatura</th>
                    <th className="ls-txt-center">R2</th>
                    <th className="ls-txt-center">Capacitação</th>
                </tr>
                </thead>
                <tbody>

                <tr>
                    <td className="ls-txt-center"><strong>Indicação</strong></td>
                    <td className="ls-txt-center"><strong> 600 </strong></td>
                    <td className="ls-txt-center"> 
                    600
                    </td>
                    <td className="ls-txt-center">600</td>
                    <td className="ls-txt-center">600</td>
                    <td className="ls-txt-center">600</td>
                    <td className="ls-txt-center">600</td>
                    <td className="ls-txt-center ls-regroup">
                    600
                    </td>
                </tr>

                <tr>
                    <td className="ls-txt-center"><strong>Actual Sales</strong></td>
                    <td className="ls-txt-center"><strong> 600 </strong></td>
                    <td className="ls-txt-center"> 
                    600
                    </td>
                    <td className="ls-txt-center">600</td>
                    <td className="ls-txt-center">600</td>
                    <td className="ls-txt-center">600</td>
                    <td className="ls-txt-center">600</td>
                    <td className="ls-txt-center ls-regroup">
                    600
                    </td>
                </tr>

                <tr>
                    <td className="ls-txt-center"><strong>Mídia</strong></td>
                    <td className="ls-txt-center"><strong> 600 </strong></td>
                    <td className="ls-txt-center"> 
                    600
                    </td>
                    <td className="ls-txt-center">600</td>
                    <td className="ls-txt-center">600</td>
                    <td className="ls-txt-center">600</td>
                    <td className="ls-txt-center">600</td>
                    <td className="ls-txt-center ls-regroup">
                    600
                    </td>
                </tr>

                </tbody>
            </table>
            </div>
        )
    }
}

ReactDOM.render(
    <Analytics />,
    document.getElementById('analise')
);
