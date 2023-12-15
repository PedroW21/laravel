import { router, usePage } from "@inertiajs/react";
import React from "react";
import { useRoute } from "ziggy-js";

const Edit = () => {
    const { support } = usePage().props;
    const { id, subject, body } = support;
    const route = useRoute();

    const handleNewSupportEdit = (e) => {
        e.preventDefault();

        const form = e.target;
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);

        router.put(route("supports.update", id), data);
    };

    return (
        <section>
            <h1> Dúvida: {id} </h1>
            <form onSubmit={handleNewSupportEdit}>
                <label htmlFor="subject">Assunto:</label>
                <input
                    type="text"
                    name="subject"
                    id="subject"
                    defaultValue={subject}
                />

                <label htmlFor="body">Descrição:</label>
                <textarea
                    name="body"
                    id="body"
                    cols="30"
                    rows="5"
                    defaultValue={body}
                ></textarea>

                <button type="submit">Enviar</button>
            </form>
        </section>
    );
};

export default Edit;
