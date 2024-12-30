SELECT fp.TXT_NOME_FP, mv.NUM_ID_MOV, cl.TXT_RAZAO_CLI, mv.VAL_VALOR_MOV, mv.TXT_REFERENTE_MOV, mv.TXT_TIPO_MOV 

FROM tbl_movimentacao_mov mv

LEFT JOIN tbl_formapagamento_fp fp

ON fp.NUM_ID_FP = TBL_FORMA_PAGAMENTO_FP_NUM_ID_FP

LEFT JOIN  tbl_cliente_cli cl

ON cl.NUM_ID_CLI = TBL_CLIENTE_CLI_NUM_ID_CLI

WHERE `TBL_CLIENTE_CLI_NUM_ID_CLI` = 1


SELECT C.TXT_RAZAO_CLI,C.VAL_SALDO_CLI, REC.VAL_VALOR_REC, REC.NUM_DOCUMENTO_REC,  
    
                            FROM TBL_RECEBIMENTO_REC REC 
                            
                            LEFT JOIN TBL_CLIENTE_CLI C ON C.NUM_ID_CLI = TBL_CLIENTE_CLI_NUM_ID_CLI 
                            
                            WHERE TXT_STATUS_REC = 'AB' AND TXT_REFERENTE_REC = 'OS' 
                            
                            order by NUM_ID_REC desc"