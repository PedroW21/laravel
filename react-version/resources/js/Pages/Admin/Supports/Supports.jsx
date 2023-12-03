import { usePage } from "@inertiajs/react";
import React from "react";

const Supports = () => {
    const { supports } = usePage().props;

    return (
        <section>
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
