class Analytics extends React.Component {
    state = {
        indicacao: [],
        midia: [],
        inicio: "",
        final: "",
        loading: false,
    };

    handleSubmit = async (e) => {
        e.preventDefault();
        try {
            this.setState({ loading: true });
            const response = await axios.post(`/api/analise`, {
                inicio: this.state.inicio,
                final: this.state.final,
            });
            this.setState({ indicacao: response.data.indicacao });
            this.setState({ midia: response.data.midia });
        } catch (err) {
            console.log(err);
        } finally {
            this.setState({ loading: false });
        }
    };

    setFinal = (e) => {
        this.setState({ final: e.target.value });
    };
    setInicio = (e) => {
        this.setState({ inicio: e.target.value });
    };

    render() {
        const { loading } = this.state;
        return (
            <div>
                <div className="col-md-8">
                    <form
                        onSubmit={this.handleSubmit}
                        className="ls-form ls-form-inline row"
                    >
                        <label className="ls-label col-md-4 col-sm-12">
                            <span
                                data-ls-module="popover"
                                data-content="Escolha o período desejado e clique em 'Filtrar'."
                            />
                            <input
                                autoComplete="off"
                                onSelect={this.setInicio}
                                onChange={this.setInicio}
                                value={this.state.inicio}
                                type="date"
                                name="range_start"
                                placeholder="dd/mm/aaaa"
                            />
                        </label>
                        <label className="ls-label col-md-4 col-sm-12">
                            <span
                                data-ls-module="popover"
                                data-content="Clique em 'Filtrar' para exibir  o período selecionado."
                            />
                            <input
                                autoComplete="off"
                                onSelect={this.setFinal}
                                onChange={this.setFinal}
                                value={this.state.final}
                                type="date"
                                name="range_end"
                                placeholder="dd/mm/aaaa"
                            />
                        </label>
                        <div className="ls-actions-btn">
                            <button className="ls-btn-primary ">
                                {" "}
                                {loading ? "Carregando" : "Filtrar"}{" "}
                            </button>
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
                            <td className="ls-txt-center">
                                <strong>Indicação</strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.indicacao.leads} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.indicacao.matriculas}{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.indicacao.conversao
                                        ? Math.floor(
                                              this.state.indicacao.conversao
                                          ) + "%"
                                        : ""}{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.indicacao.pos} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {
                                        this.state.indicacao.segundaLicenciatura
                                    }{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.indicacao.r2} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.indicacao.Capacitação}{" "}
                                </strong>
                            </td>
                        </tr>

                        <tr>
                            <td className="ls-txt-center">
                                <strong>Mídia</strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.midia.leads} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.midia.matriculas} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.indicacao.conversao
                                        ? Math.floor(
                                              this.state.midia.conversao
                                          ) + "%"
                                        : ""}{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.midia.pos} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.midia.segundaLicenciatura}{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.midia.r2} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.midia.Capacitação}{" "}
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        );
    }
}

ReactDOM.render(<Analytics />, document.getElementById("analise"));
