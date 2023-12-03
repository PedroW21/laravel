import { router } from "@inertiajs/react";
import { route } from "ziggy-js";

const Create = () => {

    const handleNewSupportCreate = (e) => {
        e.preventDefault();
        
        const form = e.target;
        const formData = new FormData(form);
        
        router.post(route('supports.store'), formData);
    }

    return (
        <section>
            <h1>Nova Dúvida</h1>

            <form method="post" onSubmit={handleNewSupportCreate} >
                <label htmlFor="subject">Assunto:</label>
                <input type="text" name="subject" id="subject" />

                <label htmlFor="body">Descrição:</label>
                <textarea name="body" id="body" cols="30" rows="5"></textarea>

                <button type="submit">Enviar</button>
            </form>
        </section>
    );
};

export default Create;
