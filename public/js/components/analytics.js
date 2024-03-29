class Analytics extends React.Component {
    state = {
        indicacao: [],
        educaedu: [],
        actualSales: [],
        midia: [],
        issoe: [],
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
            this.setState({ educaedu: response.data.educaedu });
            this.setState({ actualSales: response.data.actualSales });
            this.setState({ issoe: response.data.issoe });
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
                            <th className="ls-txt-center">EJA</th>
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
                            <td className="ls-txt-center">
                                <strong> {this.state.indicacao.EJA} </strong>
                            </td>
                        </tr>
                        <tr>
                            <td className="ls-txt-center">
                                <strong>EducaEdu</strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.educaedu.leads} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.educaedu.matriculas}{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.educaedu.conversao
                                        ? Math.floor(
                                              this.state.educaedu.conversao
                                          ) + "%"
                                        : ""}{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.educaedu.pos} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {
                                        this.state.educaedu.segundaLicenciatura
                                    }{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.educaedu.r2} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.educaedu.Capacitação}{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.educaedu.EJA} </strong>
                            </td>
                        </tr>
                        <tr>
                            <td className="ls-txt-center">
                                <strong>Actual Sales</strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.actualSales.leads}{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.actualSales.matriculas}{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.actualSales.conversao
                                        ? Math.floor(
                                              this.state.actualSales.conversao
                                          ) + "%"
                                        : ""}{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.actualSales.pos} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {
                                        this.state.actualSales
                                            .segundaLicenciatura
                                    }{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.actualSales.r2} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.actualSales.Capacitação}{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.actualSales.EJA} </strong>
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
                            <td className="ls-txt-center">
                                <strong> {this.state.midia.EJA} </strong>
                            </td>
                        </tr>
                        <tr>
                            <td className="ls-txt-center">
                                <strong>ISSOE</strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.issoe.leads} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.issoe.matriculas} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.indicacao.conversao
                                        ? Math.floor(
                                              this.state.issoe.conversao
                                          ) + "%"
                                        : ""}{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.issoe.pos} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.issoe.segundaLicenciatura}{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.issoe.r2} </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong>
                                    {" "}
                                    {this.state.issoe.Capacitação}{" "}
                                </strong>
                            </td>
                            <td className="ls-txt-center">
                                <strong> {this.state.issoe.EJA} </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        );
    }
}

ReactDOM.render(<Analytics />, document.getElementById("analise"));
