const { useState, useEffect } = wp.element;

export default function Edit() {
    const [models, setModels] = useState([]);

    useEffect(() => {
        fetch("/wp-json/spcv/v1/models")
            .then((r) => r.json())
            .then((data) => setModels(data));
    }, []);

    return (
        <div style={{ padding: "20px", border: "1px solid #ccc" }}>
            <h3>Coat Viewer</h3>
            <p>Front-end viewer will render on the site.</p>

            <p>Loaded models: {models.length}</p>
        </div>
    );
}
