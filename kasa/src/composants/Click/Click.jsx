import { useState } from "react";
import './Click.css';

function Test() {
    const [count , setCount] = useState(0);
    return (
        <div>
            <p>
                Le compteur est : {count}
            </p>
            <button onClick={() => setCount(count + 1 )}>Click</button>
            <button onClick={() => setCount(count - 1 )}>Retour</button>
        </div>
    );
}
export default Test;