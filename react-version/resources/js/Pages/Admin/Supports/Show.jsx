import { usePage } from "@inertiajs/react";
import { router } from "@inertiajs/react";
import { useRoute } from "ziggy-js";

const Show = () => {
    const { support } = usePage().props;
    const { id, subject, status, body } = support;
    const route = useRoute();

    return (
        <section>
            <h1>Detalhes da dúvida #{id}</h1>

            <ul>
                <li>Assunto: {subject}</li>
                <li>Status: {status}</li>
                <li>Descrição: {body}</li>
            </ul>

            <button
                onClick={() => router.delete(route("supports.destroy", id))}
            >
                DELETAR
            </button>
        </section>
    );
};

export default Show;
