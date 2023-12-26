import { usePage } from "@inertiajs/react";
import { useRoute } from "ziggy-js";

const Supports = () => {
    const { supports } = usePage().props;
    const route = useRoute();

    // const handleSupportEdit = (id) => {

    //     router.get(route("supports.show"), { id })

    // }

    return (
        <section>
            <h1>Listagem dos Suports</h1>

            <a href={route("supports.create")}>Criar dúvida</a>

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
                            <td className="flex gap-2 items-center justify-center ">
                                <a href={route("supports.show", support.id)}>
                                    ver
                                </a>
                                <a href={route("supports.edit", support.id)}>
                                    editar
                                </a>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </section>
    );
};

export default Supports;
