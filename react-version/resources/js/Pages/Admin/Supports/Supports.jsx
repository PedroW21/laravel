import { usePage } from "@inertiajs/react";
import { useRoute } from 'ziggy-js';

const Supports = () => {
    const { supports } = usePage().props;

    return (
        <section>
            <h1>Listagem dos Suports</h1>

            <a href={route('supports.create')}>Criar dúvida</a>

            <table>
                <thead>
                    <tr>
                        <th>assunto</th>
                        <th>status</th>
                        <th>descrição</th>
                        <th>ações</th>
                    </tr>
                </thead>
                <tbody>
                    {supports.map((support, idx) => (
                        <tr key={idx}>
                            <td>{support.subject}</td>
                            <td>{support.status}</td>
                            <td>{support.body}</td>
                            <td>
                                <button>editar</button>
                                <button>excluir</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </section>
    );
};

export default Supports;
